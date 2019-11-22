<?php defined('SITE') or die; ?>
<?php

require_once 'resource/controller.php';

class CommentController extends Controller{
    static function showComments($blog_entry_id){
        if($_SERVER['REQUEST_METHOD']==='GET'){
            try{
                require_once 'model.php';
                $comments = CommentModel::getEntryComments($blog_entry_id);
                if(empty($comments)){
                    return;
                }
                self::render('view.php', array('comments' => $comments));
            }
            catch(PDOException $e){
                Doc::add_error('Ошибка получения данных');
            }
        }
    }

    static function createComment($blog_entry_id){
        if($_SERVER['REQUEST_METHOD']==='GET'){
            self::render('form-view.php', array('text' => '', 'name' => ''));
            if(isset($_GET['success'])){
                Doc::add_message('Комментарий добавлен');
            }
        }
        elseif($_SERVER['REQUEST_METHOD']==='POST'){
            $text = isset($_POST['text']) ? prep($_POST['text']) : '';
            $name = isset($_POST['name']) ? prep($_POST['name']) : '';
            require_once 'model.php';
            $comment = compact('blog_entry_id', 'name', 'text');
            if(CommentModel::isValidComment($comment)){
                try{
                    CommentModel::addComment($comment);
                    header('Location: '.BASE."/entry/$blog_entry_id?success");
                }
                catch(PDOException $e){
                    Doc::add_error('Ошибка сохранения данных');
                }
            }
            else{
                Doc::add_error('Вы заполнили не все поля');
                self::render('form-view.php', array('text' => $text, 'name' => $name));
                Doc::set_title('Сохранение комментария');
            }
        }
    }
}