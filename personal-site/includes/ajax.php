<?php
/**
 * Date: 23.10.18
 * @author Isaenko Alexey <info@oiplug.com>
 */

include '../functions.php';

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
				$table_name = 'table-users';
			} else {

				// указываем имя таблицы в соответствии с первой составляющей ключа
				$table_name = $match[1][0];
			}

			if ( empty( $insert[$table_name] ) ) {
				$insert[$table_name] = array();
			}

			// если массивы с ключами и значениями для добавления в бд не определены
			if ( empty( $insert[$table_name][0] ) ) {

				// определяем
				$insert[$table_name][0] = array();
				$insert[$table_name][1] = array();
			}



			// если ключ имеет менее 2-х составляющих
			if ( sizeof( $match[1] ) < 2 )
			{

				// добавляем ключ в список ключей для отправки в бд(при создании записи)
				$insert[$table_name][0][] = $key;

				// добавляем в список значение с правильным синтаксисом
				if ( 's' == $value['perform'] ) {
					$insert[$table_name][1][] = "`" . $data[ $key ] . "`";
					$update[$table_name][]    = $key . '=`' . $data[ $key ] . '`';
				} else {
					$insert[$table_name][1][] = $data[ $key ];
					$update[$table_name][]    = $key . '=' . $data[ $key ];
				}


			}

		}

		// если в процессе возникли ошибки
		if ( ! empty( $error ) ) {

			// отправляем список ошибок и флаг success; false
			send_json_error( $error );

		} else {

			// проверяем на существование хоть какой-то записи в указанной таблице
			$result = do_query( 'SELECT COUNT(*) FROM `table-users`' );

			// если записей не найдено
			if ( empty( $result ) ) {

				// преобразовываем ключи и значения в строки
				$insert[$table_name][0] = implode( ', ', $insert[$table_name][0] );
				$insert[$table_name][1] = implode( ', ', $insert[$table_name][1] );

				// составляем запрос
				$query[$table_name] = 'INSERT INTO `table-users` (' . $insert[$table_name][0] . ')VALUES (' . $insert[$table_name][1] . ')';

				// выполняем запрос
				do_query( $query[$table_name] );
			} else {
				$update[$table_name] = implode( ', ', $update[$table_name] );
				$query[$table_name]  = 'UPDATE `table-users` SET ' . $update[$table_name];
			}

			send_json_success( $query );
		}


	}
}

function ajax_request() {
	if ( ! empty( $_REQUEST['action'] ) && function_exists( $_REQUEST['action'] ) ) {

		$_REQUEST['action']();
	}

	echo 0;
}

ajax_request();


// eof
