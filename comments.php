<?php defined('SITE') or die; ?>
<?php
function show_comments($blog_entry_id){
	if($_SERVER['REQUEST_METHOD']==='GET'){
		try{
			$dbh = db::get();
			$query = 'select text text, name, date_format(time, "%d.%m.%Y %H:%i") time from blog_comments where blog_entry_id=:id order by time desc';
			$sth = $dbh->prepare($query);
			$sth->execute(array(':id' => $blog_entry_id));
			$res = $sth->fetchAll();
			foreach($res as $entry){
				$text = nl2br($entry['text']);
				echo "<div class='comment-item'><div style='font-weight: bold;'>$entry[name]</div><div>$text</div><div>$entry[time]</div></div>";
			}
		}
		catch(PDOException $e){
			Doc::add_error('База данных сломалась (');
		}
	}
}
