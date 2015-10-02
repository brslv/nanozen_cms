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

	public function changeBackgroundImage($info) 
	{
		$uploadedFile = $this->uploadImage($info);

		if ($uploadedFile) {
			$query = "UPDATE options SET value = :value WHERE name = 'app_background_image'";
			$stmt = $this->db()->prepare($query);	
			$result = $stmt->execute([
				':value' => $uploadedFile,
			]);

			if ($result) {
				Session::flash('flash_messages', Communicator::IMAGE_UPLOAD_SUCCESSFULL);
				return $result;
			}
		}

		Session::flash('flash_messages', Communicator::IMAGE_UPLOAD_FAIL);
		return false;
	}

	private function uploadImage($info) 
	{
		if ( ! Validator::validateBackgroundImageUpdateInformation($info)) {
			return false;
		}

		$_info = $info['app_background_image'];

    	$fileName = $_info['name'];
    	$fileNameParts = explode('.', $fileName);
    	$fileExtension = end($fileNameParts);
    	$cleanFileName = str_replace('.' . $fileExtension, '', $fileName);
    	$tmpName = $_info['tmp_name'];
    	$error = $_info['error'];
    	$size = $_info['size'];
    	$finalName = $cleanFileName . '___' . md5(time()) . '.' . $fileExtension;
    	$uploadDestination = './uploads/' . $finalName;

    	if (move_uploaded_file($tmpName, $uploadDestination)) {
    		return $finalName;
    	}

    	return false;
	}

	public function changeBackgroundColor($info)
	{
		if ( ! Validator::validateBackgroundColorUpdateInformation($info)) {
			return false;
		}

		$query = "UPDATE options SET value = :value WHERE name = 'app_background_color'";
		$stmt = $this->db()->prepare($query);	
		$result = $stmt->execute([
			':value' => $info['app_background_color'],
		]);

		if ($result === true) {
			Session::flash('flash_messages', Communicator::SETTINGS_SUCCESSFULLY_EDITED);
		}

		return $result;
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