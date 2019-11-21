<h2>Комментарии</h2>
<?php foreach($comments as $comment): ?>
    <article class='comment-item'><div style='font-weight: bold;'><?=$comment['name']?></div><div><?=nl2br($comment['text'])?></div><div><?=$comment['time']?></div></article>
<?php endforeach ?>