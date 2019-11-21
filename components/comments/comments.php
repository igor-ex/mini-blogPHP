<?php defined('SITE') or die; ?>
<?php
function show_comments($blog_entry_id){
	if($_SERVER['REQUEST_METHOD']==='GET'){
		try{
			require_once 'model.php';
			$comments = CommentsModel::getEntryComments($blog_entry_id);
			if(empty($comments)){
				return;
			}
			render('comments/view.php', array('comments' => $comments));
		}
		catch(PDOException $e){
			Doc::add_error('Ошибка получения данных');
		}
	}
}
