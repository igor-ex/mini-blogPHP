<?php
defined('SITE') or die; ?>
<?php
function list_component(){
	if($_SERVER['REQUEST_METHOD']==='GET'){
		try{
			require_once 'model.php';
			$res = ListModel::getData();

			if(empty($res)){
				Doc::add_message('Тут еще нет записей. Стань первым!');
			}
			else{
				render('list/view.php', array('res' => $res));
			}
		}
		catch(PDOException $e){
			Doc::add_error('Ошибка получения данных');
		}
	}
	require_once 'components/entry/create-entry.php';
	create_entry_component();
}