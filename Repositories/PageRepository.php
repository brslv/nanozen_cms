<?php

namespace Nanozen\Repositories;

use Nanozen\Utilities\Escpr;
use Nanozen\Utilities\Validator;
use Nanozen\Factories\PageFactory;
use Nanozen\Utilities\Communicator;
use Nanozen\Models\Binding\PageBinding;
use Nanozen\Models\Binding\UpdatePageBinding;
use Nanozen\Providers\Session\SessionProvider as Session;
use Nanozen\Contracts\Repositories\PageRepositoryContract;

/**
* Class PageRepository
* 
* @author brslv
* @package Nanozen\Repositories
*/
class PageRepository extends BaseRepository implements PageRepositoryContract
{

    const ACTIVE_PAGE_FLAG = 'active = 1 ';
    
    const INACTIVE_PAGE_FLAG = 'active = 0 ';
    
	public function save(PageBinding $page)
	{
		if ( ! Validator::validatePageCreationInformation($page)) return;

		$query = "INSERT INTO pages(title, active) VALUES(:title, :active)";
		$stmt = $this->db()->prepare($query);
		$stmt->execute([
			':title' => $page->title,
            ':active' => $page->active,
		]);

		$id = $this->db()->lastInsertId();
		$persistedPage = $this->find(['id' => $id]);
        
		if ($id) {
			Session::flash('flash_messages', 'Page successfully added.');
		} else {
			Session::flash('flash_messages', 'An error occured. Please try again.');
		}

		return $persistedPage;
	}
    
    public function all($onlyActive = true) 
    {
        $query = "SELECT id, title, active, deleted_on FROM pages WHERE deleted_on IS NULL ";
        
        if ($onlyActive) {
            $query .= "AND " . self::ACTIVE_PAGE_FLAG;
        }
        
        $pages = $this->db()->query($query)->fetch();

        usort($pages, function ($a, $b) {
            return $a->title > $b->title;
        });
        
        return $pages;
    }

	/**
	 * Get a page frrom the database, based on id.
	 *
	 * @param  int $id 
	 * @return \Nanozen\Models\Page
	 */
	public function find(array $params, $onlyActive = true) 
	{
        // TODO: use the active field for hiding pages and deleted_on for deleting pages.
        
		if (empty($params)) {
			throw new \Exception('Params cannot be empty.');
		}
        
		$query = $this->constructQuery($params, $onlyActive);
		$executableArray = $this->constructExecutableArray($params);

		$stmt = $this->db()->prepare($query);
		$stmt->execute($executableArray);
		$page = $stmt->fetch(\PDO::FETCH_OBJ, false);
        
		return PageFactory::make($page);
	}

	private function constructQuery($params, $onlyActive = true) 
	{
		$query = "SELECT id, title, content, active, deleted_on FROM pages WHERE ";
		$counter = 0;
		$paramsCount = count($params);

		foreach ($params as $key => $value) {
			$counter++;
			$query .= $key . ' = :' . $key;	

			if ($counter == $paramsCount - 1) {
				$query .= ' AND ';
			}
		}
        
        $query .= ' AND deleted_on IS NULL';
        
        if ($onlyActive) {
            $query .= sprintf(" AND %s", self::ACTIVE_PAGE_FLAG);
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
        $page = $this->find(['id' => $id], false);
        
        if ($page) {
            $stmt = $this->db()->prepare(
                    "UPDATE pages SET active = :active, deleted_on = :deleted_on WHERE id = :id");
            
            $result = $stmt->execute([
                ':active' => 0,
                ':deleted_on' => (new \DateTime())->format('Y-m-d H:i:s'),
                ':id' => $page->getId(),
            ]);
            
            if ($result) {
                Session::flash('flash_messages', Communicator::PAGE_SUCCESSFULLY_DELETED);
                return true;
            }
        }
        
        Session::flash('flash_messages', Communicator::PAGE_DOES_NOT_EXIST);
        return false;
    }
    
    public function update($id, PageBinding $page)
    {
        if ( ! Validator::validatePageCreationInformation($page)) return; // TODO: validatePageUpdateInformation().
        
        $query = "UPDATE pages"
                . " SET title = :title, content = :content, active = :active"
                . " WHERE id = :id";
        $stmt = $this->db()->prepare($query);
        $result = $stmt->execute([
            ':title' => $page->title,
            ':content' => $page->content,
            ':active' => $page->active,
            ':id' => $id,
        ]);
        
        if ($result) {
            Session::flash('flash_messages', Communicator::PAGE_SUCCESSFULLY_EDITED);
            return true;
        }
        
        Session::flash('flash_messages', Communicator::PAGE_EDITING_FAIL);
        return false;
    }
    
    public function getRegions()
    {
        return $this->db()->query("SELECT id, region, description FROM regions")->fetch(\PDO::FETCH_ASSOC);
    }
    
    public function setHomepage($id) 
    {
        if ( ! is_numeric($id)) {
            throw new Exception("Id must be numberic");
        }
        
        $query = "UPDATE options SET value = :value WHERE name = 'app_homepage'";
        $stmt = $this->db()->prepare($query);
        $result = $stmt->execute([
            ':value' => $id,
        ]);
        
        if ($result) {
            return true;
        } 
        
        Session::flash('flash_messages', Communicator::SET_HOMEPAGE_FAIL);
        return false;
    }

}