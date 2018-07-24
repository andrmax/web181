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
		if ( $item['link'] == $_GET['p'] ) {
			$class = 'active';
		} else {
			$class = '';
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
	if ( 5 == $i ) {
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

	// если уровень вложенности больше 1-го
	if ( $i > 1 ) {
		$ul_class = 'sublist';
	} else {
		$ul_class = 'list';
	}

	$out = '<ul class="' . $ul_class . '">' . $out . '</ul>';

	return $out;
}


// eof
