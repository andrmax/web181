<?php
/**
 * Date: 26.07.18
 * @author Isaenko Alexey <info@oiplug.com>
 */

function get_template( $adds ) {
	$path = $adds . '.php';
	//print_r($path);
	if ( file_exists( $path ) ) {
		include $path;
	}
}


function save_post() {
	if ( ! empty( $_POST['save_post'] ) ) {
		$data = $_POST;

		if ( ! empty( $data['title'] ) && ! empty( $data['content'] ) ) {
			/*$data = $data['title']
			        . ';'
			        . $data['content'];*/

			$data = json_encode( $data );
			file_put_contents( 'blog/' . date( 'Y-m-d-H-i-s' ) . '.txt', $data );
			header( 'location: ?event=post_saved' );
		} else {
			return '<div class="error">Все поля формы должны быть заполнены</div>';
		}
	}

	return '';
}

function get_posts() {
	$files = scandir( 'blog' );

	rsort( $files );

	foreach ( $files as $date ) {
		if ( '.' != $date && '..' != $date ) {
			$file_content = file_get_contents( 'blog/' . $date );
			$data         = explode( ';', $file_content );

			// todo: преобразование строки содержащей дату в привычный формат: 1) преобразовать строку в timestamp 2) преобразовать timestamp в привычный формат даты

			/*$date = str_replace( '.txt', '', $date );
			$out  = '<div class="post">'
			        . '<div class="post__date">' . $date . '</div>'
			        . '<div class="post__title">' . $data[0] . '</div>'
			        . '<div class="post__content">' . $data[1] . '</div>'
			        . '</div>';*/
			//echo $out;

			$file_content = json_decode( $file_content, true );
			if ( is_array( $file_content ) ) {
				print_r( $file_content );
			} else {
				echo '<div>' . $file_content . '</div>';
			}

		}
	}
}

/**
 * Проверка, является ли пользователь авторизованным
 * Проверка производится на соответсвие данных в куках данным в файле users.db
 *
 * @return bool
 */
function is_user_logged_in() {
	if ( ! empty( $_COOKIE['login_password'] ) ) {
		list( $login, $password ) = explode( ';', $_COOKIE['login_password'] );
	}


	if ( ! empty( $login ) && ! empty( $password ) ) {
		$users = file_get_contents( 'users.db' );
		$users = explode( "\n", $users );
		foreach ( $users as $user ) {
			list( $log, $pass ) = explode( ';', $user );

			if ( $log == $login && $pass == $password ) {
				return true;
			}
		}
	}

	return false;
}

function get_hash( $string ) {
	return md5( $string . 'f5a823476b0bbc09a66cec6020176c93' );
}

function login() {
	if ( ! empty( $_POST['event'] ) && $_POST['event'] == 'login' ) {
		$data = $_POST;

		setcookie( 'login_password',
			$data['login']
			. ';'
			. get_hash( $data['password'] ),
			time() + 3600,
			'/' );
		header( 'location: ?' );
	}
}

function logout() {
	if ( ! empty( $_GET['event'] ) && $_GET['event'] == 'logout' ) {
		print_r( $_GET );

		setcookie( 'login_password', '',
			time() - 24 * 3600, '/' );
		header( 'location: ?' );
	}
}


function registration() {
	$out = '';
	if ( ! empty( $_POST['event'] ) && $_POST['event'] == 'registration' ) {
		$data = $_POST;
		$file = file_get_contents( 'users.db' );

		$users = explode( "\n", $file );
		foreach ( $users as $user ) {
			list( $log ) =
				explode( ';', $user );

			if ( $log == $data['login'] ) {
				$out = 'Пользователь с указанным логином уже существует!';

				return $out;
			}
		}

		$file .= $data['login'] . ';' . get_hash( $data['password'] ) . "\n";
		file_put_contents( 'users.db', $file );

		setcookie( 'login_password',
			$data['login']
			. ';'
			. get_hash( $data['password'] ),
			time() + 3600,
			'/' );
		header( 'location: ?' );
	}

	return $out;
}


// eof
