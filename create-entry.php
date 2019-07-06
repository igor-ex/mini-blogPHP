<?php defined('SITE') or die; ?>
<?php
if($_SERVER['REQUEST_METHOD']==='GET'){
	show_form(array('text' => '', 'name' => ''));
	if(isset($_GET['success'])){
		Doc::add_message('Вы создали новый пост!');
	}
}
elseif($_SERVER['REQUEST_METHOD']==='POST'){
	$text = prep($_POST['text']);
	$name = prep($_POST['name']);
	if($text!=='' and $name!==''){
		try{
			$dbh = db::get();
			$query = 'insert into blog_entries set text=:text, name=:name';
			$sth = $dbh->prepare($query);
			$sth->execute(array(':text' => $text, ':name' => $name));
			//проверить вставилась ли запись
			header('Location: '.BASE.'?success');
		}
		catch(PDOException $e){
			Doc::add_error('База данных сломалась (');
		}
	}
	else{
		Doc::add_error('Вы не заполнили все поля');
		show_form(array('text' => $text, 'name' => $name));
	}
}

function show_form($form_data){
?>
<form method="POST">
	<input type="text" name="name" value="<?=$form_data['name']?>">
	<textarea name="text" class="textarea"><?=$form_data['text']?></textarea>
	<button type="submit">Сохранить</button>
</form>
<?php
}