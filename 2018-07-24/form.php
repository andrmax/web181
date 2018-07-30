Задача: 1) чтение всех файлов сделать построчным
2) добавление нового пользователя сделать так, чтобы информация дописывалась в конец файла, а не происходило чтение с последующей перезаписью
3) добавить визуализацию для форм и публикаций
4) При авторизации, если пользователь ввел не корректные данные - выводить сообщение об этом
5) После того, как пользователь авторизовался где-то на странице выводить его имя(логин): Привет, admin


<?php
$text = 'bruce_lee';

if(!empty($_COOKIE['login_password'])){
	$cookie = explode( ';',$_COOKIE['login_password']);
	echo '<div>' . $text . '</div>';
	echo '<div>' . md5( $text ) . '</div>';
	echo '<div>' . $cookie[1] . '</div>';

}


if ( is_user_logged_in() ) {
	$errors = save_post();
	$data   = array(
		'title'   => '',
		'content' => '',
	);
	if ( ! empty( $errors ) ) {
		$data = $_POST;
	}
	echo $errors;
	?>
	<form method="post" class="form">
		<input type="text" name="title" value="<?php echo $data['title']; ?>">
		<textarea name="content" id="" cols="30" rows="10"
		          class="form__textarea"><?php echo $data['content']; ?></textarea>
		<button type="submit" class="form__submit">ok</button>
		<input type="hidden" name="save_post" value="1">
	</form>

	<a href="?event=logout">Log out</a>
	<?php
} else {
	get_template( 'auth' );
	get_template( 'registration' );
}
