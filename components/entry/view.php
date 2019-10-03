<article class="blog-entry">
    <h2 class="blog-enrty__title">Запись пользователя <?=$entry['name']?></h2>
    <div class="blog-entry__text"><?=nl2br($entry['text'])?></div>
    <div><?=$entry['time']?></div>
    <?php if($entry['comments']): ?>
    <div>Комментариев: <?=$entry['comments']?></div>
    <?php endif; ?>
</article>