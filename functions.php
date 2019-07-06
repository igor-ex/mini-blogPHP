<?php
function prep($data){
//очищение данных для повторного вывода в html-форме
	return htmlspecialchars(strip_tags(trim($data)),ENT_QUOTES,'UTF-8');
}