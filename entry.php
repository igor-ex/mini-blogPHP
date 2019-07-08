<?php defined('SITE') or die; ?>
<?php
Doc::set_title('Мой блог');
Doc::set_description('Блог про все');
Doc::set_keywords('блог');
if(empty($_GET['id'])){
	render_404();
	return;
}

echo '<div><a href="'.BASE.'">Все записи</a></div>';
$id = $_GET['id'];

try{
	$query = 'select e.id, e.text, e.name, date_format(e.time, "%d.%m.%Y") time, count(c.id) comments
	from blog_entries e left join blog_comments c on e.id=c.blog_entry_id where e.id=:id';
	$dbh = db::get();
	$sth = $dbh->prepare($query);
	$sth->execute(array(':id' => $id));
	$entry = $sth->fetch();
	if(is_null($entry['id'])){
		render_404();
		return;
	}
	Doc::set_title('Пост гостя '.$entry['name']);
	Doc::set_description('Пост гостя '.$entry['name']);
?>
<article class="blog-entry">
	<h2 class="blog-enrty__title">Запись пользователя <?=$entry['name']?></h2>
	<div class="blog-entry__text"><?=nl2br($entry['text'])?></div>
	<div><?=$entry['time']?></div>
	<?php if($entry['comments']): ?>
	<div>Комментариев: <?=$entry['comments']?></div>
	<?php endif; ?>
</article>
<?php
}
catch(PDOException $e){
	Doc::add_error('Ошибка получения данных');
}
require_once 'comments.php';
show_comments($id);
require_once 'create-comment.php';