<?php

namespace Nanozen\Repositories;

use Nanozen\Utilities\Escpr;
use Nanozen\Utilities\Validator;
use Nanozen\Factories\PageFactory;
use Nanozen\Utilities\Communicator;
use Nanozen\Models\Binding\StorePageBinding;
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

    const ACTIVE_PAGE_FLAG = 1;
    
    const INACTIVE_PAGE_FLAG = 0;
    
	public function save(StorePageBinding $page)
	{
		if ( ! Validator::validatePageCreationInformation($page)) return;

		$query = "INSERT INTO pages(title, content) VALUES(:title, :content)";
		$stmt = $this->db()->prepare($query);
		$stmt->execute([
			':title' => $page->title,
			':content' => $page->content,
		]);

		$id = $this->db()->lastInsertId();
		$persistedPage = $this->find(['id' => $id]);

		if ($id) {
            $pageTitle = $persistedPage->getTitle();
			Session::flash('flash_messages', 'Page "' . Escpr::escape($pageTitle) . '" successfully added.');
		} else {
			Session::flash('flash_messages', 'En error occured. Please try again.');
		}

		return $persistedPage;
	}
    
    public function all($onlyActive = true) 
    {
        $query = "SELECT id, title, content, active, deleted_on FROM pages";
        
        if ($onlyActive) {
            $query .= " WHERE active = 1";
        }
        
        $pages = $this->db()->query($query)->fetch();
        
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
		if (empty($params)) {
			throw new \Exception('Params cannot be empty.');
		}

		$query = $this->constructQuery($params);
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
				$query .= ', ';
			}
		}
        
        $query .= sprintf(" AND active = %s", $onlyActive ? self::ACTIVE_PAGE_FLAG : self::INACTIVE_PAGE_FLAG);

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
        $page = $this->find(['id' => $id]);
        
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
        } else {
            Session::flash('flash_messages', Communicator::PAGE_DOES_NOT_EXIST);
        }
    }

}