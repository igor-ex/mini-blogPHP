<?php defined('SITE') or die; ?>
<?php
function create_comment_component($blog_entry_id){
	if($_SERVER['REQUEST_METHOD']==='GET'){
		render('comments/form-view.php', array('text' => '', 'name' => ''));
		if(isset($_GET['success'])){
			Doc::add_message('Комментарий добавлен');
		}
	}
	elseif($_SERVER['REQUEST_METHOD']==='POST'){
		$text = isset($_POST['text']) ? prep($_POST['text']) : '';
		$name = isset($_POST['name']) ? prep($_POST['name']) : '';
		require_once 'model.php';
		$comment = compact('blog_entry_id', 'name', 'text');
		if(CommentsModel::isValidComment($comment)){
			try{
				CommentsModel::addComment($comment);
				header('Location: '.BASE."/entry/$blog_entry_id?success");
			}
			catch(PDOException $e){
				Doc::add_error('Ошибка сохранения данных');
			}
		}
		else{
			Doc::add_error('Вы заполнили не все поля');
			render('comments/form-view.php', array('text' => $text, 'name' => $name));
			Doc::set_title('Сохранение комментария');
		}
	}
}