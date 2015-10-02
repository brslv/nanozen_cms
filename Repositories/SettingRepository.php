<?php

namespace Nanozen\Repositories;

use Nanozen\Utilities\Validator;
use Nanozen\Repositories\BaseRepository;
use Nanozen\Providers\Session\SessionProvider as Session;
use Nanozen\Utilities\Communicator;

/**
 * Class SettingRepository
 *
 * @author brslv
 * @package Nanozen\Repositories 
 */
class SettingRepository extends BaseRepository
{

	public function changeBackground()
	{
		
	}
	
	public function update($info) 
	{
		if ( ! Validator::validateSettingsUpdateInformation($info)) {
			return false;
		}

		$_info = (array) $info;

		// ddd($info, $_info);

		foreach ($_info as $title => $value) {
			$query = 'UPDATE options ';
			$query .= 'SET value = :value';
			$query .= " WHERE name = '" . $title . "'";
			// ddd($query);
			$stmt = $this->db()->prepare($query);
			$stmt->execute([
				':value' => $value,
			]);
		}

		Session::flash('flash_messages', Communicator::SETTINGS_SUCCESSFULLY_EDITED);
		return true;
	}

}