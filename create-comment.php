<?php defined('SITE') or die; ?>
<?php
if($_SERVER['REQUEST_METHOD']==='GET'){
	show_form(array('text' => '', 'name' => ''));
	if(isset($_GET['success'])){
		Doc::add_message('Комментарий добавлен');
	}
}
elseif($_SERVER['REQUEST_METHOD']==='POST'){
	$blog_entry_id = $_GET['id'];
	$text = isset($_POST['text']) ? prep($_POST['text']) : '';
	$name = isset($_POST['name']) ? prep($_POST['name']) : '';
	if($text!=='' and $name!==''){
		try{
			$dbh = db::get();
			$query = 'insert into blog_comments set text=:text, name=:name, blog_entry_id=:id';
			$sth = $dbh->prepare($query);
			$sth->execute(array(':text' => $text, ':name' => $name, ':id' => $blog_entry_id));
			//проверить вставилась ли запись
			header('Location: '.BASE."?page=entry&id=$blog_entry_id&success");
		}
		catch(PDOException $e){
			Doc::add_error('Ошибка сохранения данных');
		}
	}
	else{
		Doc::add_error('Вы заполнили не все поля');
		show_form(array('text' => $text, 'name' => $name));
		Doc::set_title('Сохранение комментария');
	}
}
function show_form($form_data){
?>
<h2>Добавьте новый комментарий</h2>
<form method="POST">
	<label for="createCommentName" class="label">Ваше имя:</label>
	<input type="text" name="name" value="<?=$form_data['name']?>" id="createCommentName" class="text-input">
	<label for="createCommentText" class="label">Текст комментария:</label>
	<textarea name="text" class="textarea" id="createCommentText"><?=$form_data['text']?></textarea>
	<button type="submit">Сохранить</button>
</form>
<?php
}