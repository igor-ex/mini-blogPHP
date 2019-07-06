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
<main>
<?php
Doc::print_messages();
echo $content;
?>
</main>
<footer class="footer"></footer>
</body>
</html>
