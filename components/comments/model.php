<?php defined('SITE') or die; ?>
<?php
class CommentModel{
    static function getEntryComments($blog_entry_id){
        $dbh = db::get();
        $query = 'select text text, name, date_format(time, "%d.%m.%Y") time
        from blog_comments where blog_entry_id=:id order by time desc';
        $sth = $dbh->prepare($query);
        $sth->execute(array(':id' => $blog_entry_id));
        return $sth->fetchAll();
    }

    static function addComment($data){
        $dbh = db::get();
        $query = 'insert into blog_comments set text=:text, name=:name, blog_entry_id=:id';
        $sth = $dbh->prepare($query);
        $sth->execute(array(
            ':text' => $data['text'],
            ':name' => $data['name'],
            ':id' => $data['blog_entry_id']
        ));
    }

    static function isValidComment($data){
        extract($data);
        return $text!='' and $name!='';
    }
}