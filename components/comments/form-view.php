<h2>Добавьте новый комментарий</h2>
<form method="POST">
	<label for="createCommentName" class="label">Ваше имя:</label>
	<input type="text" name="name" value="<?=$name?>" id="createCommentName" class="text-input">
	<label for="createCommentText" class="label">Текст комментария:</label>
	<textarea name="text" class="textarea" id="createCommentText"><?=$text?></textarea>
	<button type="submit">Сохранить</button>
</form>