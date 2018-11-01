<?php
/**
 * Date: 23.10.18
 * @author Isaenko Alexey <info@oiplug.com>
 */
require '../db.php';
require '../functions.php';
global $link;

function send_json_success( $data = null ) {
	$data = json_encode( array(
		'success' => true,
		'data'    => $data,
	) );

	echo $data;
	die();
}

function send_json_error( $data = null ) {
	$data = json_encode( array(
		'success' => false,
		'data'    => $data,
	) );

	echo $data;
	die();
}

/**
 * Обновление данных профиля
 */
function update_profile() {
	if ( ! empty( $_REQUEST ) ) {
		$data = $_REQUEST;

		$fields  = fields_profile();
		$error   = array();
		$insert  = array();
		$update  = array();
		$matches = array();
		$query   = array();

		// делаем перебор полей, определенных в специальном массиве
		foreach ( $fields as $key => $value ) {

			// если поле является обязательным для заполнения
			if ( ! empty( $value['required'] ) && empty( $data[ $key ] ) ) {

				// добавляем информацию об этом в список ошибок
				$error[] = 'Поле "' . $value['label'] . '" должно быть заполнено!';
			}


			// ищем в ключе все составляющие(слова)
			preg_match_all( '/([^\[\]]+)/i', $key, $match );

			// добавляем найденные составляющие ключа в общий список(это для тестирования)
			$matches[] = $match;

			// если ключ имеет менее 2-х составляющих
			if ( 1 == sizeof( $match[1] ) ) {

				// указываем стандартное имя таблицы
				$table_name = 'users';
			} else {

				// указываем имя таблицы в соответствии с первой составляющей ключа
				$table_name = $match[1][0];
			}

			if ( empty( $insert[ $table_name ] ) ) {
				$insert[ $table_name ] = array( array(), array(), );
			}

			// если массивы с ключами и значениями для добавления в бд не определены
			/*if ( empty( $insert[$table_name][0] ) ) {

				// определяем
				$insert[$table_name][0] = ;
				$insert[$table_name][1] = array();
			}*/


			// если ключ имеет менее 2-х составляющих
			if ( sizeof( $match[1] ) < 2 ) {

				// добавляем ключ в список ключей для отправки в бд(при создании записи)
				$insert[ $table_name ][0][] = $key;

				// добавляем в список значение с правильным синтаксисом
				if ( 's' == $value['perform'] ) {
					$insert[ $table_name ][1][] = "'" . $data[ $key ] . "'";
					$update[ $table_name ][]    = $key . "='" . $data[ $key ] . "'";
				} else {
					$insert[ $table_name ][1][] = $data[ $key ];
					$update[ $table_name ][]    = $key . '=' . $data[ $key ];
				}


			} else {
				$insert[ $table_name ][0][] = "'" . $match[1][1] . "'";
				$insert[ $table_name ][1][] = "'" . $data[ $match[1][0] ][ $match[1][1] ] . "'";
			}
			$query[ $table_name ] = '';
		}
		//send_json_success( $insert);
		// если в процессе возникли ошибки
		if ( ! empty( $error ) ) {

			// отправляем список ошибок и флаг success; false
			send_json_error( $error );

		} else {
			foreach ( $query as $table_name => $data ) {

				if ( in_array( $table_name, array( 'users', ) ) ) {
					// проверяем на существование хоть какой-то записи в указанной таблице
					//$result = do_query( 'SELECT COUNT(*) FROM `' . $table_name . '`' );

					update_user( array(
						'keys'   => $insert[ $table_name ][0],
						'values' => $insert[ $table_name ][1],
					), $update );

				} else {

					// идет перебор мета-данных
					foreach ( $insert[ $table_name ][0] as $i => $meta_key ) {

						// добавление мета-данных пользователя
						update_user_meta( $meta_key, $insert[ $table_name ][1][ $i ] );

					}

				}

				// если записей не найдено
				if ( empty( $result ) ) {

					// преобразовываем ключи и значения в строки
					$insert[ $table_name ][0] = implode( ', ', $insert[ $table_name ][0] );
					$insert[ $table_name ][1] = implode( ', ', $insert[ $table_name ][1] );

					// составляем запрос
					$query[ $table_name ] = 'INSERT INTO `' . $table_name . '` (' . $insert[ $table_name ][0] . ')VALUES (' . $insert[ $table_name ][1] . ')';


				} else {
					$update[ $table_name ] = implode( ', ', $update[ $table_name ] );
					$query[ $table_name ]  = 'UPDATE `' . $table_name . '` SET ' . $update[ $table_name ];
				}

				// выполняем запрос
				do_query( $query[ $table_name ] );
			}
			send_json_success( $query );
		}


	}
}

function update_user( $insert, $update ) {

	$query  = 'SELECT COUNT(*) FROM `users`';
	$result = do_query( $query );

	if ( empty( $result ) ) {
		$insert['keys']   = implode( ', ', $insert['keys'] );
		$insert['values'] = implode( ', ', $insert['values'] );
		$query            = 'INSERT INTO `users` (' . $insert['keys'] . ')VALUES (' . $insert['values'] . ')';
	} else {
		$update = implode( ', ', $update );
		$query  = 'UPDATE `users` SET ' . $update;
	}
	//send_json_success( $query );
	do_query( $query );
}


/**
 * Функция добавления/обновления мета-данных пользователя
 *
 * @param $meta_key
 * @param $meta_value
 */
function update_user_meta( $meta_key, $meta_value ) {
	$query  = 'SELECT COUNT(*) FROM `usermeta` WHERE `key` = ' . $meta_key;
	$result = do_query( $query );
	send_json_success( [$query,$result->num_rows] );
	if ( ! empty( $result ) ) {
		$query = "UPDATE `usermeta` SET `value` = '{$meta_value}' WHERE `key` = '{$meta_key}'";
	} else {
		$query = "INSERT INTO `usermeta`  (`key`,`value`)VALUES({$meta_key},{$meta_value})";

	}

	// fixme: сделать проверку на корректность запроса, тк он не отрабатывает
	$result = do_query( $query );
	send_json_success( [$query,$result] );
}


function ajax_request() {
	if ( ! empty( $_REQUEST['action'] ) && function_exists( $_REQUEST['action'] ) ) {

		$_REQUEST['action']();
	}

	echo 0;
}

ajax_request();


// eof
