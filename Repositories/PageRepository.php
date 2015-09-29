<?php

namespace Nanozen\Repositories;

use Nanozen\Models\Page;
use Nanozen\Utilities\Util;
use Nanozen\Utilities\Hash;
use Nanozen\Utilities\Validator;
use Nanozen\Factories\PageFactory;
use Nanozen\Utilities\Communicator;
use Nanozen\Models\Binding\StorePageBinding;
use Nanozen\Providers\Session\SessionProvider as Session;
use Nanozen\Contracts\Repositories\PageRepositoryContract;
use Nanozen\Providers\Redidect\RedirectProvider as Redirect;

/**
* Class PageRepository
* 
* @author brslv
* @package Nanozen\Repositories
*/
class PageRepository extends BaseRepository implements PageRepositoryContract
{

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
			Session::flash('flash_messages', 'Page "' . Util::e($persistedPage->getTitle()) . '" successfully added.');
		} else {
			Session::flash('flash_messages', 'En error occured. Please try again.');
		}

		return $persistedPage;
	}

	/**
	 * Get a page frrom the database, based on id.
	 *
	 * @param  int $id 
	 * @return \Nanozen\Models\Page
	 */
	public function find(array $params) 
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

	private function constructQuery($params) 
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