<?php
function prep($data){
//очищение данных для повторного вывода в html-форме
	return htmlspecialchars(strip_tags(trim($data)),ENT_QUOTES,'UTF-8');
}

function render_404(){
	header('HTTP/1.1 404 Not Found');
	echo '<div class="error-404">Ошибка 404<br>Страница не найдена</div>';
}

function render($path, $args=false){
	if(is_array($args)){
		extract($args);
	}
	require 'components/'.$path;
}

function ex($a,$string='',$b='auto'){  //посмотреть что лежит в переменной
	echo '<pre style="border:1px solid #fd5; background:rgba(255,200,50,.2); padding:7px; overflow-x:auto;">';
	if($string)
		echo $string.' = ';
	if($b=='print_r'){
		print_r($a);
		}
	elseif($b=='echo'){
		echo $a;
	}
	elseif($b=='var_dump'){
		var_dump($a);
	}
	elseif($b=='auto'){
		if(gettype($a)=='array'){
			print_r($a);
		}
		elseif((gettype($a)=='null') or (gettype($a)=='boolean')){
			var_dump($a);
		}
		elseif((gettype($a)=='string') or (gettype($a)=='integer')){
			echo $a;
		}
		else{
			var_dump($a);
		}
	}
	elseif($b=='my_flag'){
		echo '--MY FLAG--';
	}
	echo "</pre>";
}