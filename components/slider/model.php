<?php defined('SITE') or die; ?>
<?php

class SliderModel{
    static function getData(){
        $dbh = db::get();
        $sth = $dbh->query('select e.id, left(e.text,100) text, e.name, date_format(e.time, "%d.%m.%Y") time, count(c.id) comments from blog_entries e left join blog_comments c on e.id=c.blog_entry_id
        group by e.id having comments>0 order by comments desc, e.time desc limit 5');
        return $sth->fetchAll();
    }
}