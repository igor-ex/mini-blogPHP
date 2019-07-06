<?php defined('SITE') or die; ?>
<div><a href="<?=BASE?>">Все записи</a></div>
<?php
$id = $_GET['id'];
try{
	$query = 'select e.id, e.text, e.name, date_format(e.time, "%d.%m.%Y %H:%i") time, count(c.id) comments from blog_entries e left join blog_comments c on e.id=c.blog_entry_id where e.id=:id';
	$dbh = db::get();
	$sth = $dbh->prepare($query);
	$sth->execute(array(':id' => $id));
	$entry = $sth->fetch();
	$text = nl2br($entry['text']);
	echo "<div style='font-weight: bold;'>$entry[name]</div><div>$text</div><div>$entry[time]</div><div>comments $entry[comments]</div>";
}
catch(PDOException $e){
	Doc::add_error('База данных сломалась (');
}
require_once 'comments.php';
show_comments($id);
require_once 'create-comment.php';