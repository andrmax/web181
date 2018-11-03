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

		// если в процессе возникли ошибки
		if ( ! empty( $error ) ) {

			// отправляем список ошибок и флаг success; false
			send_json_error( $error );

		} else {

			// перебор имен таблиц в которые будет происходить запись
			foreach ( $query as $table_name => $data ) {

				// если текущее имя таблицы присутствует в массиве
				if ( in_array( $table_name, array( 'users', ) ) ) {

					// производим сохранение обязательных данных пользователя
					$result = update_user( array(
						'keys'   => $insert[ $table_name ][0],
						'values' => $insert[ $table_name ][1],
					), $update );

					// если возникла ошибка
					if ( false == $result ) {

						// добавлеям текст ошибки к списку ошибок
						$error[] = 'Данные пользователя не добавились в БД.';
					}
				} else {

					// идет перебор мета-данных
					foreach ( $insert[ $table_name ][0] as $i => $meta_key ) {

						// добавление мета-данных пользователя
						$result = update_user_meta( $meta_key, $insert[ $table_name ][1][ $i ] );

						// если возникла ошибка
						if ( false == $result ) {

							// добавлеям текст ошибки к списку ошибок
							$error[] = 'Метаданные с ключом ' . $meta_key . ' не добавились в БД.';
						}
					}
				}
			}

			// если есть ошибки
			if ( ! empty( $error ) ) {

				// отправляем список ошибок и флаг success: false
				send_json_error( $error );

			} else {

				// отправляем флаг success: true
				send_json_success();
			}
		}


	}
}



/**
 * Функция обновления обязательных данных пользователя
 *
 * @param $insert
 * @param $update
 *
 * @return bool|mysqli_result|string
 */
function update_user( $insert, $update ) {

	// проверка на наличае хоть каких-то данных
	/*$query  = 'SELECT COUNT(*) FROM `users`';
	$result = do_query( $query );
	$result = (int) $result->fetch_row()[0];*/

	// если данных нет
	//if ( empty( $result ) )
	{

		// формируем запрос на добавление
		$insert['keys']   = implode( ', ', $insert['keys'] );
		$insert['values'] = implode( ', ', $insert['values'] );
		$query            = 'INSERT INTO `users` (' . $insert['keys'] . ')VALUES (' . $insert['values'] . ')';
	}/* else {

		$user_id = <функция получения id пользователя>;
		// если данные есть, обновляем их
		$update = implode( ', ', $update );
		$query  = 'UPDATE `users` SET ' . $update . ' WHERE id = '.$user_id;
	}*/

	//send_json_success( $query );
	return do_query( $query );
}


/**
 * Функция добавления/обновления мета-данных пользователя
 *
 * @param $meta_key
 * @param $meta_value
 *
 * @return bool|mysqli_result|string
 */
function update_user_meta( $meta_key, $meta_value ) {

	// проверка на существование записи с указанными параметрами
	$query  = 'SELECT COUNT(*) FROM `usermeta` WHERE `key` = ' . $meta_key;
	$result = do_query( $query );
	$result = (int) $result->fetch_row()[0];

	// если запись существует
	if ( ! empty( $result ) ) {

		// запрос н аобновление
		$query = "UPDATE `usermeta` SET `value` = {$meta_value} WHERE `key` = {$meta_key}";
	} else {

		// запрос на добавление
		$query = "INSERT INTO `usermeta`  (`key`,`value`)VALUES({$meta_key},{$meta_value})";
	}

	// возврат результата выполнения запроса
	return do_query( $query );
}

/**
 * Функция отслеживания ajax запросов
 */
function ajax_request() {
	if ( ! empty( $_REQUEST['action'] ) && function_exists( $_REQUEST['action'] ) ) {

		$_REQUEST['action']();
	}

	echo 0;
}

ajax_request();


// eof
