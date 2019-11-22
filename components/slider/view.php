<div class="slider-container">
    <?php foreach($data as $entry): ?>
        <article class='slider-container__entry'>
        <div style='font-weight: bold;'><?=$entry['name']?></div>
        <div><?=nl2br($entry['text'])?></div><div><?=$entry['time']?></div>
        <div>Комментариев: <?=$entry['comments']?></div>
        <div><a href='entry/<?=$entry['id']?>'>перейти на страницу</a></div>
        </article>
    <?php endforeach; ?>
</div>
<script src="public/slider.js"></script>