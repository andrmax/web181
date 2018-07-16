<?php
/**
 * Date: 05.07.18
 * @author Isaenko Alexey <info@oiplug.com>
 */


function esc( $data ) {
	$data = strip_tags( $data );
	$data = htmlspecialchars( $data );

	return $data;
}

function pr( $data ) {
	echo '<pre>';
	print_r( $data );
	echo '</pre>';
}

function check_form() {
	//print_r( $_POST );

	$errors = array();

	// если осуществляется передача данных
	if ( ! empty( $_POST ) ) {
		$data = $_POST;

		$needle = array(
			'email'    => 'Не введен Email, либо он не корректный',
			'password' => 'Не введен пароль',
			'agree'    => 'Вам необходимо согласиться с условиями',
		);

		foreach ( $needle as $name => $value ) {

			// если значение переданной переменной пусто
			if ( ! ( ! empty( $data[ $name ] ) && ! empty(  $data[ $name ]  ) ) ) {

				$errors[] = $needle[ $name ];
			}
		}

		if ( empty( $errors ) ) {

			// регистрируем пользователя
			$errors = array_merge( $errors, register( $data ) );
		}
	}

	return $errors;
}

function the_errors() {
	$errors = check_form();
	if ( ! empty( $errors ) ) {
		foreach ( $errors as $i => $error ) {
			$errors[ $i ] = '<li>' . $errors[ $i ] . '</li>';
		}
		$errors = '<ul class="errors">' . implode( '', $errors ) . '</ul>';
		echo $errors;
	}
}


function register( $data ) {
	foreach ( $data as $key => $value ) {
		$data[ $key ] = esc( $data[ $key ] );
	}
	$errors = array();
	$users  = explode( "\n", file_get_contents( 'users.txt' ) );
	foreach ( $users as $user ) {
		$user = json_decode( $user, true );
		if ( $user['email'] == $data['email'] ) {
			$errors[] = 'Пользователь с указанным Email существует!';

			return $errors;
		}
	}
//Дозапись строки в файл
	file_put_contents( 'users.txt', json_encode( $data ) . "\n" , FILE_APPEND);
	header( 'location: ?register=success' );
}





/*
1. Дописать функцию esc
2. Написать функцию проверки введенного email'а
3. Решить примеры по булевой алгебре
4. Сделать чтение файла построчно
5. Использовать добавление данных в файл, дописывая его, а не переписывая, чтобы файл содержал данные нескольких пользователей

*/

// eof
