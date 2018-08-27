<?php echo registration(); ?>
<h2>Регистрация</h2>
<form class="form" method="post">
	<div class="form__group">
	<input type="text" class="form__input" name="email">
	</div>
	<div class="form__group">
	<input type="password" class="form__input" name="password">
	</div>
	<button type="submit" class="button">Register</button>
	<input type="hidden" name="event" value="registration">
</form>
