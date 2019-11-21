<?php
use Models\ModelException;
use Models\ListModel;
defined('SITE') or die; ?>
<?php
function list_component(){
	if($_SERVER['REQUEST_METHOD']==='GET'){
		try{
			require 'model.php';
			$res = ListModel::get_data();

			if(empty($res)){
				Doc::add_message('Тут еще нет записей. Стань первым!');
			}
			else{
				render('list/view.php', array('res' => $res));
			}
		}
		catch(ModelException $e){
			Doc::add_error($e->getMessage());
		}
	}
	require_once 'components/entry/create-entry.php';
	create_entry_component();
}