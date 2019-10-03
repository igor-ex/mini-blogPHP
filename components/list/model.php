<?php defined('SITE') or die; ?>
<?php
class ModelException extends Exception{}
    
function get_data(){
    try{
        $dbh = db::get();
        $sth = $dbh->query('select e.id, left(e.text,100) text, e.name, date_format(e.time, "%d.%m.%Y") time, count(c.id) comments
        from blog_entries e left join blog_comments c on e.id=c.blog_entry_id
        group by e.id order by e.time desc');
        $res = $sth->fetchAll();
        return $res;
    }
    catch(PDOException $e){
        throw new ModelException('Ошибка получения данных');
    }
}