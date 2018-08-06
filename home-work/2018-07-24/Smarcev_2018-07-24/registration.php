<?php echo registration(); ?>
<div class="h2_logreg"><h2 class="h2_logreg__h2">Регистрация</h2></div>
<form class="form-registration" method="post">
	<input type="text" class="form-registration__login" name="login" placeholder="login">
	<input type="password" class="form-registration__password" name="password" placeholder="password">
	<button type="submit" class="form-registration__submit">Register</button>
	<input type="hidden" name="event" value="registration">
</form>
