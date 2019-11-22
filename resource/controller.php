<?php defined('SITE') or die; ?>
<?php
abstract class Controller{
    static function render($path, $args=false){  //вызывает view по относительному пути
        $refl = new ReflectionClass(get_called_class());
        $file = $refl->getFileName();
        $path = dirname(realpath($file)).'/'.$path;
        call_user_func(function() use ($path, $args){
            if(is_array($args)){
                extract($args);
            }
            require $path;
        });
    }
}