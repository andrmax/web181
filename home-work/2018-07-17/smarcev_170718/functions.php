<?php
/**
 * Date: 17.07.18
 * @author Isaenko Alexey <info@oiplug.com>
 */


function init() {

	if ( empty( $_GET['p'] ) ) {
		$file = 'main';
	} else {
		$file = $_GET['p'];
	}

	include 'templates/header.php';
	include $file . '.php';
	include 'templates/footer.php';
}

function menu() {
	$items = array(
		array(
			'link'    => '',
			'caption' => 'Главная',
		),
		array(
			'link'    => 'about',
			'caption' => 'О нас',
		),
		array(
			'link'    => 'contacts',
			'caption' => 'Контакты',
		),
	);

	$out   = '';
	$class = '';
	foreach ( $items as $item ) {

		//fixme: нужно добавить проверку на существование $_GET['p']
		if (!empty($_GET['p'])) {
			if ( $item['link'] == $_GET['p'] ) {
				$class = 'active';
			} else {
				$class = '';
			}
		}
		$out .= '<li class="' . $class . '"><a href="./?p=' . $item['link'] . '">' . $item['caption'] . '</a></li>';
	}

	$out = '<ul>' . $out . '</ul>';

	return $out;
}

/**
 * Рекурсивная функция, составляющая вложенные списки на основе переданного в нее массива.
 *
 * Не обязательным параметром является парамтр, показывающий уровень вложенности, на котором мы находимся.
 *
 * @param     $array
 * @param int $i
 *
 * @return string
 */
function recursive( $array, $i = 0 ) {

	// 1 - это константа, которая определяет уровень, ниже которого не следует строить вложенные списки
	if ( 1 == $i ) {
		return '';
	}
	$i ++;
	$out = '';
	foreach ( $array as $item ) {

		$out .= '<li>' . $item['text'];
		if ( ! empty( $item['sub'] ) ) {
			$out .= recursive( $item['sub'], $i );
		}
		$out .= '</li>';

	}

	$out = '<ul>' . $out . '</ul>';

	return $out;
}


/**
 * Функция по определению количества цифр в числе и
 * Разделить на 10 в степени n, где n = число знаков минус 1
отбросить дробную часть
 *
 * 
 *
 */

function stvalue($val_1) {

	$qw=getLength($val_1); // Определяем количество знаков числа
	echo 'Количество знаков числа:'.$qw.'<br>';
	$qw_1 =$val_1/pow(10,$qw-1);
	$qw_1 = floor($qw_1);
	echo 'Если число поделить на 10 в степени n, где n - число знаков числа, то получится:'.$qw_1;
}

// функция возвращает кол-во цифр в натуральном числе.
function getLength($number) {
	$length = 0;
	if ($number == 0){
		$length = 1;
	} else {
		$length = (int) log10($number)+1;
	}
	return $length;
}

// функция, которая принимает в качестве параметра строку, которая является путем к файлу, который надо подключить и подключает его get_template('templates/bio')
function get_template( $str_1 ) {
	$sect_1 = 'templates/bio/' . $str_1 . '.php';
	if ( file_exists( $sect_1) ) {
		include $sect_1;
	}
}

// eof
