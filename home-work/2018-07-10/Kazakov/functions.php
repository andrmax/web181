<?php
/**
 * Date: 05.07.18
 * @author Isaenko Alexey <info@oiplug.com>
 */


function esc( $data ) {
	$data = strip_tags( $data );
	$data = htmlspecialchars( $data );
    $data = trim($data);//удаляет прообелы слева и справа от строки
    $data = stripcslashes($data);//stripslashes — Удаляет экранирование символов (удаляет управляющий слэш)


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
        check_mail();//функция проверки e-mail
		$data = $_POST;
		$needle = array(
			'email'    => 'Не введен Email, либо он не корректный',
			'password' => 'Не введен пароль',
			'agree'    => 'Вам необходимо согласиться с условиями',
		);

		foreach ( $needle as $name => $value ) {
			// если значение переданной переменной пусто
			if ( ! ( ! empty( $data[ $name ] ) && ! empty( esc( $data[ $name ] ) ) ) ) {

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

function check_mail(){
    if(!filter_var ($_POST['email'], FILTER_VALIDATE_EMAIL)){
        $_POST['email'] = '';
    };
};

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
	//Реализация дозаписывания в файл
    $f = file_get_contents('users.txt');
	file_put_contents( 'users.txt', $f."\n".json_encode( $data )  );
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
