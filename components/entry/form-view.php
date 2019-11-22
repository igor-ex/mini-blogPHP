<h2>Добавьте новую запись</h2>
<form method="POST">
	<label for="createEntryName" class="label">Ваше имя:</label>
	<input type="text" name="name" value="<?=$name?>" id="createEntryName" class="text-input">
	<label for="createEntryText" class="label">Текст поста:</label>
	<textarea name="text" class="textarea" id="createEntryText"><?=$text?></textarea>
	<button type="submit">Сохранить</button>
</form>