<?php
/**
 * Date: 14.08.18
 * @author Isaenko Alexey <info@oiplug.com>
 */


function registration() {
	$out = '';
	if ( ! empty( $_POST['event'] ) && $_POST['event'] == 'registration' ) {
		$data   = $_POST;
		$result = do_query( "SELECT COUNT(*) as count FROM users WHERE email = '{$data['email']}'" );

		$result = $result->fetch_object();
		if ( ! empty( $result->count ) ) {
			$out = "Пользователь с таким Email'ом существует. Укажите другой Email, либо авторизуйтесь.";
		} else {
			$data['password'] = get_hash( $data['password'] );
			do_query( "INSERT INTO users (`email`,`password`)VALUES ('{$data['email']}','{$data['password']}')" );
			print_r( $data['password'] );
			setcookie( 'login_password',
				$data['email']
				. ';'
				. $data['password'],
				time() + 3600,
				'/' );
			header( 'location: ?' );
		}
	}

	return $out;
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

	//print_r( $_COOKIE['login_password'] );
	if ( ! empty( $login ) && ! empty( $password ) ) {


		$result = do_query( "SELECT COUNT(*) as count FROM users WHERE email = '{$login}' AND password = '{$password}'" );

		$result = $result->fetch_object();

		if ( ! empty( $result->count ) ) {
			//print_r( $result->count );
			return true;
		}
	}

//echo 'sdf';
	return false;
}

function get_hash( $string ) {
	return md5( $string . 'f5a823476b0bbc09a66cec6020176c93' );
}

function login() {

	if ( ! empty( $_REQUEST['event'] ) && $_REQUEST['event'] == 'login' ) {
		$data = $_REQUEST;
		setcookie( 'login_password',
			$data['email']
			. ';'
			. get_hash( $data['password'] ),
			time() + 3600,
			'/' );
		header( 'location: ?' );
	}
}

function logout() {
	if ( ! empty( $_GET['event'] ) && $_GET['event'] == 'logout' ) {
		//print_r( $_GET );

		setcookie( 'login_password', '',
			time() - 24 * 3600, '/' );
		header( 'location: ?' );
	}
}



// eof
