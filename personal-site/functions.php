<?php
/**
 * Date: 18.10.18
 * @author Isaenko Alexey <info@oiplug.com>
 */
global $link;

define( 'SECRET', 'vnrlsotnkNJKflkb56bjjbf' );

function is_admin() {

	$password = '123';

	$hash = md5( $password . SECRET );

	if ( ( ! empty( $_REQUEST['pass'] ) && md5( $_REQUEST['pass'] . SECRET ) == $hash ) || ( ! empty( $_COOKIE['hash'] ) && $_COOKIE['hash'] == $hash ) ) {

		setcookie( 'hash', $hash, time() + 3600, '/' );

		return true;
	}

	return false;
}


function pr( $data ) {
	echo '<pre>';
	print_r( $data );
	echo '</pre>';
}

function do_query( $query ) {
	global $link;

	$result = mysqli_query( $link, $query );

	if ( $error = mysqli_error( $link ) ) {
		return $error;
	}

	return $result;
}

/**
 * perform - ключ, который указывает на то, какой тип данных у данной переменной, чтобы правильно сохранить их в БД,
 * варианты: d - целые числа f - числа с точкой s - все остальное
 * @return array
 */
function fields_profile() {

	$values = get_last_user_data();
	$values = array_merge( $values, get_user_meta() );

	$fields = array(
		'fio'               => array(
			'label'    => 'Имя и Фамилия',
			'perform'  => 's',
			'type'     => 'text',
			'class'    => 'form__controll',
			'required' => 1,
		),
		'bio'               => array(
			'label'   => 'Биография',
			'perform' => 's',
			'type'    => 'text',
			'class'   => 'form__controll',
		),
		'birthday'          => array(
			'label'   => 'ДР',
			'perform' => 's',
			'type'    => 'date',
			'class'   => 'form__controll',
		),
		'email'             => array(
			'label'    => 'Email',
			'perform'  => 's',
			'type'     => 'text',
			'class'    => 'form__controll',
			'required' => 1,
		),
		'phone'             => array(
			'label'   => 'Телефон',
			'perform' => 's',
			'type'    => 'text',
			'class'   => 'form__controll',
		),
		'usermeta[vk_link]' => array(
			'label'   => 'Ссылка VK',
			'perform' => 's',
			'type'    => 'text',
			'class'   => 'form__controll',
		),
		'usermeta[fb_link]' => array(
			'label'   => 'Ссылка Facebook',
			'perform' => 's',
			'type'    => 'text',
			'class'   => 'form__controll',
		),
	);

	foreach ( $values as $key => $value ) {
		if ( ! empty( $fields[ $key ] ) ) {
			$fields[ $key ]['value'] = $value;
		}
	}

	if ( empty( $fields['birthday']['value'] ) || '0000-00-00' == $fields['birthday']['value'] ) {
		$fields['birthday']['value'] = date( 'Y-m-d' );
	}

	return $fields;
}

/**
 * Получение последней редакции данных пользователя
 *
 * @return array
 */
function get_last_user_data() {
	$query  = 'SELECT * FROM `users` ORDER BY id DESC LIMIT 1';
	$result = do_query( $query );
	$result = $result->fetch_assoc();

	if ( empty( $result ) ) {
		$result = array();
	}

	return $result;
}

function get_user_meta() {
	$query   = 'SELECT * FROM `usermeta`';
	$result  = do_query( $query );
	$respose = array();
	while ( $row = $result->fetch_assoc() ) {
		if ( ! empty( $row ) ) {
			$key             = 'usermeta[' . $row['key'] . ']';
			$respose[ $key ] = $row['value'];
		}
	}

	return ( $respose );
}


function get_user() {


	$data = array(
		'image' => '<img src="assets/images/photo.png" alt="" class="bio__image">',
		'bio'   => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid dignissimos dolorum enim eveniet, exercitationem, hic ipsa iure laboriosam laborum maiores omnis, placeat possimus quibusdam quod veritatis! Doloribus eaque exercitationem voluptatem?',
		'meta'  => array(
			'dob'      => 1920,
			'address'  => 'Moscow',
			'phone'    => '+7 (903) 123 45 67',
			'email'    => 'minita@yandex.ru',
			'site'     => 'minita.ru',
			'vk_link'  => 'https://vk.com/minita.ru',
			'vk_image' => '',
			'fb_link'  => 'https://facebook.com/minitaru',
			'fb_image' => '',
		),
	);

	return $data;
}


function get_resume() {


	$fields = array(
		array(
			'start'       => '2015-03-01',
			'end'         => '2015-12-01',
			'position'    => 'Механик',
			'location'    => 'Сызрань',
			'description' => 'Работал в автосервисе, делал все.',
		),
		array(
			'start'       => '2016-01-01',
			'end'         => '2016-03-01',
			'position'    => 'Механик-электрик',
			'location'    => 'Саратов',
			'description' => 'Выкручивал лампочки',
		),
		array(
			'start'       => '2016-04-01',
			'end'         => '0000-00-00',
			'position'    => 'Механик-танцор',
			'location'    => 'Москва',
			'description' => 'Ничего не делаю, но деньги получаю.',
		),
	);

	return $fields;
}





/*
 * 1) Разработать архитектуру БД таким образом, чтобы туда можно было поместить данные, которые мы предварительно разместили в массивах.
 *
 * Таблица пользователя:
 * id пользователя
 * ФИО
 * Био
 * День рожденья
 * Email
 * Номер телефона
 *
 * Дополнительные данные пользователя(user_meta):
 * id строки
 * ключ строки
 * значение строки
 *
 * Резюме:
 * id места работы
 * Дата начала работы
 * Дата окончания
 * Должность
 * Локация
 * Описание
 *
 * Разделы сайта:
 * id раздела
 * Название(имя раздела на русском языке)
 * Имя раздела, которое фигурирует в url'е
 *
 *
 * ДЗ(23.10.2018):
 * JS: Сделать так, чтобы после вывода сообщения об успешном или не успешном сохранении данных это сообщение пропадало черех Х секунд.
 *
 *
 *
 *
 */

// eof
