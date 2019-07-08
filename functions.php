<?php
function prep($data){
//очищение данных для повторного вывода в html-форме
	return htmlspecialchars(strip_tags(trim($data)),ENT_QUOTES,'UTF-8');
}

function render_404(){
	header('HTTP/1.1 404 Not Found');
	echo '<div class="error-404">Ошибка 404<br>Страница не найдена</div>';
}