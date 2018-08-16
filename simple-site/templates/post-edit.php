<form method="post" class="post-edit">
	<div class="post-edit__group">
	<input type="datetime-local" name="date" value="<?php echo $data['date']; ?>">
	</div>
	<div class="post-edit__group">
	<input type="text" name="title" value="<?php echo $data['title']; ?>">
	</div>
	<div class="post-edit__group">
	<textarea name="content" id="" cols="30" rows="10"
	          class="form__textarea"><?php echo $data['content']; ?></textarea>
	</div>
	<button type="submit" class="form__submit">ok</button>
	<input type="hidden" name="save_post" value="1">
	<input type="text" name="id" value="<?php echo $data['id']; ?>">
</form>
