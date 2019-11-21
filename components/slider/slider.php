<?php defined('SITE') or die; ?>
<?php
function slider_component(){
	if($_SERVER['REQUEST_METHOD']==='GET'){
		try{
			require_once 'model.php';
			$data = SliderModel::getData();
			if(empty($data)){
				return;
			}
			render('slider/view.php', array('data' => $data));
		}
		catch(PDOException $e){
			Doc::add_error('Ошибка получения данных');
		}
	}
}