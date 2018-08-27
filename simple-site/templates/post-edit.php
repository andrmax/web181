<form method="post" class="form">
	<div class="form__group">
	<input class="form__input" type="datetime-local" name="date" value="<?php echo $data['date']; ?>">
	</div>
	<div class="form__group">
	<input class="form__input" type="text" name="title" value="<?php echo $data['title']; ?>">
	</div>
	<div class="form__group">
	<textarea name="content" id="" cols="30" rows="10"
	          class="form__textarea"><?php echo $data['content']; ?></textarea>
	</div>
	<button type="submit" class="button button_success">ok</button>
	<input type="hidden" name="save_post" value="1">
	<input type="hidden" name="id" value="<?php echo $data['id']; ?>">
</form>
