<?php
const SITE = '';
require_once 'resource/settings.php';
require_once 'resource/db-connection.php';
require_once 'resource/Doc.php';
require_once 'resource/functions.php';

Doc::set_title('Мой блог');
Doc::set_description('Блог про все');
Doc::set_keywords('блог');

ob_start();

require_once 'routes.php';
routes();

$content = ob_get_clean();
require_once('template/template.php');

db::disconnect();