<?php defined('SITE') or die; ?>
<?php
function routes(){
	$virtual_path = substr((string)parse_url(rawurldecode($_SERVER['REQUEST_URI']),PHP_URL_PATH),strlen(BASE_PATH));
	$matches = array();

	if($virtual_path === '/'){
		define('PAGE', 'ENTRY_LIST');
		require_once 'components/entry/controller.php';
		EntryController::entryList();
	}
	elseif(preg_match('@^/entry/([\d]+)$@', $virtual_path, $matches)){
		define('PAGE', 'ENTRY');
		require_once 'components/entry/controller.php';
		EntryController::entry($matches[1]);
	}
	else{
		define('PAGE', 'WRONG_PAGE');
		render_404();
	}
}