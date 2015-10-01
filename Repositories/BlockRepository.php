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
        $query = "SELECT id, title, description, content, block_type_id, page_id, region, active, deleted_on, hash FROM blocks WHERE deleted_on IS NULL ";
        
        if ($onlyActive) {
            $query .= "AND " . self::ACTIVE_BLOCK_FLAG;
        }
        
        $blocks = $this->db()->query($query)->fetch();
        
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
        
        $blocksColumns = 'title, description, content, block_type_id, page_id, region';
        $values = ':title, :description, :content, :block_type_id, :page_id, :region';
        $query = "INSERT INTO blocks({$blocksColumns}) VALUES({$values})";
		$stmt = $this->db()->prepare($query);
		$stmt->execute([
			':title' => $block->title,
            ':description' => $block->description,
			':content' => $block->content,
            ':block_type_id' => $block->blockTypeId,
            ':page_id' => $block->pageId,
            ':region' => $block->region,
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
    
	public function find(array $params, $onlyActive = true) 
	{
        
		if (empty($params)) {
			throw new \Exception('Params cannot be empty.');
		}

		$query = $this->constructQuery($params, $onlyActive);
		$executableArray = $this->constructExecutableArray($params);

		$stmt = $this->db()->prepare($query);
		$stmt->execute($executableArray);
		$block = $stmt->fetch(\PDO::FETCH_OBJ, false);

		return BlockFactory::make($block);
	}

	private function constructQuery($params, $onlyActive = true) 
	{
		$query = "SELECT id, title, description, content, block_type_id, page_id, region, active, deleted_on, hash FROM blocks WHERE ";
		$counter = 0;
		$paramsCount = count($params);

		foreach ($params as $key => $value) {
			$counter++;
			$query .= $key . ' = :' . $key;	

			if ($counter == $paramsCount - 1) {
				$query .= ', ';
			}
		}
        
        $query .= ' AND deleted_on IS NULL';
        
        if ($onlyActive) {
            $query .= sprintf(" AND %s", self::ACTIVE_BLOCK_FLAG);
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

}
