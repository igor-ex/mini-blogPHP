<section class="blog-entries-list">
<?php foreach($entries as $entry): ?>
	<article class="blog-entry">
		<h3 class="blog-enrty__title"><?=$entry['name']?>:</h3>
		<div class="blog-entry__text"><?=nl2br($entry['text'])?></div>
		<div><?=$entry['time']?></div>
		<?php if($entry['comments']): ?>
		<div>Комментариев: <?=$entry['comments']?></div>
		<?php endif; ?>
		<div><a href="entry/<?=$entry['id']?>">Перейти на страницу</a></div>
	</article>
<?php endforeach; ?>
</section>