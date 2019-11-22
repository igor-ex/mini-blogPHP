<?php defined('SITE') or die; ?>
<?php

class EntryModel{
	static function getData($id){
		$query = 'select e.id, e.text, e.name, date_format(e.time, "%d.%m.%Y") time, count(c.id) comments
		from blog_entries e left join blog_comments c on e.id=c.blog_entry_id where e.id=:id';
		$dbh = db::get();
		$sth = $dbh->prepare($query);
		$sth->execute(array(':id' => $id));
		return $sth->fetch();
	}

	static function addEntry($data){
		extract($data);
		$dbh = db::get();
		$query = 'insert into blog_entries set text=:text, name=:name';
		$sth = $dbh->prepare($query);
		$sth->execute(array(':text' => $text, ':name' => $name));
	}

	static function isValidEntry($data){
		extract($data);
		return $text!='' and $name!='';
	}
}