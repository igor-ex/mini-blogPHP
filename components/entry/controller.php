<?php defined('SITE') or die; ?>
<?php

require_once 'resource/controller.php';

class EntryController extends Controller{
    static function entry($id){
        echo '<div><a href="">Все записи</a></div>';
        try{
            require_once 'model.php';
            $entry = EntryModel::getData($id);
            if(is_null($entry['id'])){
                render_404();
                return;
            }
            Doc::set_title('Пост гостя '.$entry['name']);
            Doc::set_description('Пост гостя '.$entry['name']);
            self::render('view.php', array('entry' => $entry));
        }
        catch(PDOException $e){
            Doc::add_error('Ошибка получения данных');
        }
    
        require_once 'components/comments/controller.php';
        CommentController::showComments($id);
        CommentController::createComment($id);
    }

    static function entryList(){
        if($_SERVER['REQUEST_METHOD']==='GET'){
            try{
                require_once 'model.php';
                $entries = EntryModel::getEntryList();
    
                if(empty($entries)){
                    Doc::add_message('Тут еще нет записей. Хочешь добавить?');
                }
                else{
                    self::render('list-view.php', array('entries' => $entries));
                }
            }
            catch(PDOException $e){
                Doc::add_error('Ошибка получения данных');
            }
        }
        
        self::createEntry();
    }

    static function createEntry(){
        if($_SERVER['REQUEST_METHOD']==='GET'){
            self::render('form-view.php', array('text' => '', 'name' => ''));

            if(isset($_GET['success'])){
                Doc::add_message('Ваш пост добавлен');
            }
        }
        elseif($_SERVER['REQUEST_METHOD']==='POST'){
            $text = isset($_POST['text']) ? prep($_POST['text']) : '';
            $name = isset($_POST['name']) ? prep($_POST['name']) : '';

            require_once 'model.php';
            $entry = compact('name', 'text');

            if(EntryModel::isValidEntry($entry)){
                try{
                    EntryModel::addEntry($entry);
                    header('Location: '.BASE.'?success');
                }
                catch(PDOException $e){
                    Doc::add_error('Ошибка сохранения данных');
                }
            }
            else{
                Doc::add_error('Вы заполнили не все поля');
                self::render('form-view.php', array('text' => $text, 'name' => $name));
                Doc::set_title('Сохранение поста');
            }
        }
    }
}