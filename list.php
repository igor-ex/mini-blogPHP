<?php defined('SITE') or die; ?>
<?php
if($_SERVER['REQUEST_METHOD']==='GET'){
	try{
		$dbh = db::get();
		$sth = $dbh->query('select e.id, left(e.text,100) text, e.name, date_format(e.time, "%d.%m.%Y") time, count(c.id) comments
		from blog_entries e left join blog_comments c on e.id=c.blog_entry_id
		group by e.id order by e.time desc');
		$res = $sth->fetchAll();
		if(empty($res)){
			Doc::add_message('Тут еще нет записей. Стань первым!');
		}
		else{
?>
<section class="blog-entries-list">
<?php foreach($res as $entry): ?>
	<article class="blog-entry">
		<h3 class="blog-enrty__title"><?=$entry['name']?>:</h3>
		<div class="blog-entry__text"><?=nl2br($entry['text'])?></div>
		<div><?=$entry['time']?></div>
		<?php if($entry['comments']): ?>
		<div>Комментариев: <?=$entry['comments']?></div>
		<?php endif; ?>
		<div><a href="<?=BASE?>/?page=entry&amp;id=<?=$entry['id']?>">Перейти на страницу</a></div>
	</article>
<?php endforeach; ?>
</section>
<?php
		}
	}
	catch(PDOException $e){
		Doc::add_error('Ошибка получения данных');
	}
}

require_once 'create-entry.php';