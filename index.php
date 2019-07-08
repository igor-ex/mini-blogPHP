<?php
mb_internal_encoding('UTF-8');
const DS = DIRECTORY_SEPARATOR;
const DOMAIN = 'localhost';
header("Content-type:text/html;charset=utf-8");
const SITE = '';
error_reporting(E_ALL);
ini_set('display_errors',1);
date_default_timezone_set('Europe/Kiev');
define('BASE_PATH',preg_replace('@/[^/]+$@','',$_SERVER['SCRIPT_NAME']));
define('BASE','http://'.DOMAIN.BASE_PATH);
require_once "db-connection.php";
require_once 'Doc.php';
require_once 'functions.php';

Doc::set_title('Мой блог');
Doc::set_description('Блог про все');
Doc::set_keywords('блог');

$page = isset($_GET['page']) ? $_GET['page'] : false;
ob_start();

switch($page){
	case 'entry':
		define('PAGE', 'ENTRY');
		require_once 'entry.php';
	break;
	
	case false:
		define('PAGE', 'LIST');
		require_once 'list.php';
	break;
	
	default:
		define('PAGE', 'WRONG_PAGE');
		render_404();
}

$content = ob_get_clean();
require_once('template.php');
db::disconnect();