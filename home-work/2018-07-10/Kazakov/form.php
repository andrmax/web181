<?php
the_errors();
if ( empty( $_GET['register'] ) || $_GET['register'] != 'success' ) {
	?>
	<form action="" method="post" class="form">
		<h2 class="form__title">Регистрация</h2>
		<div class="form__group">
			<label for="email" class="form__label">Email</label>
			<input type="email" id="email" name="email" class="form__input">
		</div>
		<div class="form__group">
			<label for="password" class="form__label">Пароль</label>
			<input type="password" id="password" name="password" class="form__input">
		</div>
		<div class="form__group">
			<label class="form__label">
				<input type="checkbox" name="agree" class="form__input"> Я согласен с <a href="privacy.php">политикой
					безопасности</a>
			</label>

		</div>
		<button type="submit" class="form__button">Ок</button>
	</form>
	<?php
} else {
	?>
	Спасибо за регистрацию!<br>
	<?php
    //Построчное чтение
    $s = fopen('users.txt','r');
    while (!feof($s)) {
        $line = fgets($s, 1024);
        echo $line.'<br>';
    };
}