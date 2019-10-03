<?php defined('SITE') or die; ?>
<!DOCTYPE html>
<html lang="ru">
<head>
<?php require_once 'head.php'; ?>
</head>
<body>
<header class="blog-header">
	<h1 class="blog-header__title"><a href="<?=BASE?>" class="blog-header__title-link">Мой блог</a></h1>
</header>
<div class="wrapper">
	<main class="main">
	<?php
	Doc::print_messages();
	echo $content;
	?>
	</main>
	<aside class="sidebar">
	<?php
	if(PAGE==='LIST'){
		require_once 'components/slider.php';
		slider_component();
	}
	?>
	</aside>
</div>
<footer class="footer"></footer>
</body>
</html>
