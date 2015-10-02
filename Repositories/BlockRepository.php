<?php

namespace Nanozen\Repositories;

use Nanozen\Utilities\Validator;
use Nanozen\Factories\BlockFactory;
use Nanozen\Utilities\Communicator;
use Nanozen\Repositories\BaseRepository;
use Nanozen\Providers\Session\SessionProvider as Session;
use Nanozen\Contracts\Repositories\BlockRepositoryContract;

/**
 * Class BlockRepository
 *
 * @author brslv
 * @package \Nanozen\Repositories
 */
class BlockRepository extends BaseRepository implements BlockRepositoryContract
{
    
    const ACTIVE_BLOCK_FLAG = 'active = 1';

    public function all($onlyActive = true) 
    {
        $query = "SELECT blocks.id, blocks.title, blocks.description, blocks.content, block_type_id, page_id, region, blocks.active, blocks.deleted_on, blocks.hash, pages.title as page_title FROM blocks "
                . "INNER JOIN pages ON pages.id = blocks.page_id "
                . "WHERE blocks.deleted_on IS NULL ";
        
        if ($onlyActive) {
            $query .= "AND blocks." . self::ACTIVE_BLOCK_FLAG;
        }
        
        $blocks = $this->db()->query($query)->fetch();

        usort($blocks, function ($a, $b) {
            return $a->page_title > $b->page_title;
        });

        return $blocks;
    }
    
    /**
     * 
     * @param $block Any type of block-related binding model
     * @return type
     */
    public function save($block)
    {   
        if ( ! Validator::validateBlockCreationInformation($block)) return;
        
        $blocksColumns = 'title, description, content, block_type_id, page_id, region, active';
        $values = ':title, :description, :content, :block_type_id, :page_id, :region, :active';
        $query = "INSERT INTO blocks({$blocksColumns}) VALUES({$values})";
		$stmt = $this->db()->prepare($query);
		$stmt->execute([
			':title' => $block->title,
            ':description' => $block->description,
			':content' => $block->content,
            ':block_type_id' => $block->blockTypeId,
            ':page_id' => $block->pageId,
            ':region' => $block->region,
            ':active' => $block->active,
		]);

		$id = $this->db()->lastInsertId();        
		$persistedBlock = $this->find(['id' => $id]);

		if ($id) {
			Session::flash('flash_messages', Communicator::BLOCK_SUCCESSFULLY_CREATED);
		} else {
			Session::flash('flash_messages', Communicator::ERROR);
		}

		return $persistedBlock;
    }
    
	public function find(array $params, $onlyActive = true, $all = false) 
	{
        
		if (empty($params)) {
			throw new \Exception('Params cannot be empty.');
		}

		$query = $this->constructQuery($params, $onlyActive);
        
		$executableArray = $this->constructExecutableArray($params);

		$stmt = $this->db()->prepare($query);
		$stmt->execute($executableArray);
		$block = $stmt->fetch(\PDO::FETCH_OBJ, $all);

        if ($all) {
            $blocks = [];
            
            foreach ($block as $b) {
                $blocks[] = BlockFactory::make($b);
            }

            usort($blocks, function ($a, $b) {
                return strcasecmp($a->getPageTitle(), $b->getPageTitle());  
            });

            return $blocks;
        }
        
		return BlockFactory::make($block);
	}

	private function constructQuery($params, $onlyActive = true) 
	{
		$query = "SELECT blocks.id, blocks.title, blocks.description, blocks.content, block_type_id, page_id, region, blocks.active, blocks.deleted_on, blocks.hash, pages.title as page_title FROM blocks "
                . "INNER JOIN pages ON pages.id = blocks.page_id "
                . "WHERE ";
		$counter = 0;
		$paramsCount = count($params);

		foreach ($params as $key => $value) {
			$counter++;
			$query .= 'blocks.' . $key . ' = :' . $key;	

			if ($counter == $paramsCount - 1) {
				$query .= ' AND ';
			}
		}
        
        $query .= ' AND blocks.deleted_on IS NULL';
        
        if ($onlyActive) {
            $query .= sprintf(" AND blocks.%s", self::ACTIVE_BLOCK_FLAG);
        }

		return $query;
	}

	private function constructExecutableArray($params)
	{
		$executableArray = [];

		foreach ($params as $key => $value) {
			$executableArray[':' . $key] = $value;
		}

		return $executableArray;
	}
    
    public function remove($id)
    {
        $block = $this->find(['id' => $id], false);
        
        if ($block) {
            $stmt = $this->db()->prepare(
                    "UPDATE blocks SET active = :active, deleted_on = :deleted_on WHERE id = :id");
            
            $result = $stmt->execute([
                ':active' => 0,
                ':deleted_on' => (new \DateTime())->format('Y-m-d H:i:s'),
                ':id' => $block->getId(),
            ]);
            
            if ($result) {
                Session::flash('flash_messages', Communicator::BLOCK_SUCCESSFULLY_DELETED);
                return true;
            }
        }
        
        Session::flash('flash_messages', Communicator::BLOCK_DOES_NOT_EXIST);
        return false;
    }
    
    public function update($id, $block)
    {
        if ( ! Validator::validateBlockCreationInformation($block)) return;
        
        $query = "UPDATE blocks"
                . " SET title = :title, description = :description, content = :content, page_id = :page_id, region = :region, active = :active"
                . " WHERE id = :id";
        $stmt = $this->db()->prepare($query);
        $result = $stmt->execute([
            ':title' => $block->title,
            ':description' => $block->description,
            ':content' => $block->content,
            ':page_id' => $block->pageId,
            ':region' => $block->region,
            ':active' => $block->active,
            ':id' => $id,
        ]);
        
        if ($result) {
            Session::flash('flash_messages', Communicator::BLOCK_SUCCESSFULLY_EDITED);
            return true;
        }
        
        Session::flash('flash_messages', Communicator::BLOCK_EDITIN_FAIL);
        return false;
    }

}
