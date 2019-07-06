<?php defined('SITE') or die; ?>
<?php
require_once 'slider.php';
if($_SERVER['REQUEST_METHOD']==='GET'){
	try{
		$dbh = db::get();
		$sth = $dbh->query('select e.id, left(e.text,100) text, e.name, date_format(e.time, "%d.%m.%Y %H:%i") time, count(c.id) comments from blog_entries e left join blog_comments c on e.id=c.blog_entry_id group by e.id order by e.time desc');
		$res = $sth->fetchAll();
		foreach($res as $entry){
			$text = nl2br($entry['text']);
			echo "<div class='blog-entry'><div style='font-weight: bold;'>$entry[name]</div><div>$text</div><div>$entry[time]</div><div>comments $entry[comments]</div><div><a href='".BASE."/?page=entry&amp;id=$entry[id]'>перейти на страницу</a></div></div>";
		}
	}
	catch(PDOException $e){
		Doc::add_error('База данных сломалась (');
	}
}

require_once 'create-entry.php';