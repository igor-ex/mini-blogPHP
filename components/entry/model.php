<?php
namespace Models;
defined('SITE') or die; ?>
<?php
class ModelException extends \Exception{}

class EntryModel{
	static function get_data($id){
		try{
			$query = 'select e.id, e.text, e.name, date_format(e.time, "%d.%m.%Y") time, count(c.id) comments
			from blog_entries e left join blog_comments c on e.id=c.blog_entry_id where e.id=:id';
			$dbh = \db::get();
			$sth = $dbh->prepare($query);
			$sth->execute(array(':id' => $id));
			return $sth->fetch();
		}
		catch(PDOException $e){
			throw new ModelException('Ошибка получения данных');
		}
	}
}