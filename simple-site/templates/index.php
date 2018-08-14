<?php
/**
 * Date: 14.08.18
 * @author Isaenko Alexey <info@oiplug.com>
 */
global $post;
get_template( 'header' );

$posts = get_posts();
if ( ! empty( $posts ) ) {


	if (  is_user_logged_in() !== true) {
		echo registration();
		?>
		<h2>Регистрация</h2>
		<form class="form-registration" method="post">
			<input type="text" class="form-registration__login" name="email">
			<input type="password" class="form-registration__password" name="password">
			<button type="submit" class="form-registration__submit">Register</button>
			<input type="hidden" name="event" value="registration">
		</form>
		<?php
	}
	//phpinfo();
	while ( $post = $posts->fetch_assoc() ) {
		get_template( 'content' );
	}
	pagination();
}

get_template( 'footer' );

// eof
