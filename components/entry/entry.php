<?php
defined('SITE') or die; ?>
<?php
function entry_component($id){
	echo '<div><a href="">Все записи</a></div>';

	try{
		require_once 'model.php';
		$entry = EntryModel::getData($id);
		if(is_null($entry['id'])){
			render_404();
			return;
		}
		Doc::set_title('Пост гостя '.$entry['name']);
		Doc::set_description('Пост гостя '.$entry['name']);
		render('entry/view.php', array('entry' => $entry));
	}
	catch(PDOException $e){
		Doc::add_error('Ошибка получения данных');
	}

	require_once 'components/comments/comments.php';
	show_comments($id);
	require_once 'components/comments/create-comment.php';
	create_comment_component($id);
}