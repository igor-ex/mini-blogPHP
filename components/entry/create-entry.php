<?php defined('SITE') or die; ?>
<?php
function create_entry_component(){
	function show_form($form_data){
?>
<h2>Добавьте новую запись</h2>
<form method="POST">
	<label for="createEntryName" class="label">Ваше имя:</label>
	<input type="text" name="name" value="<?=$form_data['name']?>" id="createEntryName" class="text-input">
	<label for="createEntryText" class="label">Текст поста:</label>
	<textarea name="text" class="textarea" id="createEntryText"><?=$form_data['text']?></textarea>
	<button type="submit">Сохранить</button>
</form>
<?php
	}
	
	if($_SERVER['REQUEST_METHOD']==='GET'){
		show_form(array('text' => '', 'name' => ''));
		if(isset($_GET['success'])){
			Doc::add_message('Ваш пост добавлен');
		}
	}
	elseif($_SERVER['REQUEST_METHOD']==='POST'){
		$text = isset($_POST['text']) ? prep($_POST['text']) : '';
		$name = isset($_POST['name']) ? prep($_POST['name']) : '';
		
		if($text!=='' and $name!==''){
			try{
				$dbh = db::get();
				$query = 'insert into blog_entries set text=:text, name=:name';
				$sth = $dbh->prepare($query);
				$sth->execute(array(':text' => $text, ':name' => $name));
				header('Location: '.BASE.'?success');
				exit;
			}
			catch(PDOException $e){
				Doc::add_error('Ошибка сохранения данных');
			}
		}
		else{
			Doc::add_error('Вы заполнили не все поля');
			show_form(array('text' => $text, 'name' => $name));
			Doc::set_title('Сохранение поста');
		}
	}
}