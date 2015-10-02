<?php  
	use \Nanozen\Models\UserRoles;
	
	if ($user->getRole() == UserRoles::ADMIN) {
		include app_back_navigation();
	} elseif ($user->getRole() == UserRoles::EDITOR) {
		include app_back_navigation_editor(); 
	}
?>