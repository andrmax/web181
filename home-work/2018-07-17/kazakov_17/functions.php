<?php
/**
 * Date: 17.07.18
 * @author Isaenko Alexey <info@oiplug.com>
 */

//Сделаk функцию, которая принимает в качестве параметра строку, которая является путем к файлу, который надо
//	подключить и подключает его
function get_template($adds){//
    if (file_exists('templates/'.$adds.'.php')){
        include 'templates/'.$adds.'.php';
    }
};

//Определение первой цифры числа
function opred($numeric){
    $numeric = (integer) $numeric;
    for($j = 1; (integer)($numeric / pow(10, $j)) > 0; $j++){};
        $digit = $numeric / pow(10, --$j);
        $digit = (integer) $digit;
        echo 'Первая цифра числа '.$numeric.' - '.$digit;
};

//В момент первой загрузки страницы возникал " Notice: Undefined index: p", в связи с чем, я решил изменить function init()
function init() {

	if ( empty( $_GET['p'] ) ) {
	    $_GET['p'] = 'main';
		//$file = 'main';
	} /*else {
		$file = $_GET['p'];
	}*/

	include 'templates/header.php';
	include $_GET['p'] . '.php';
    get_template('test');
    opred(97829);
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
		if ( $item['link'] == $_GET['p'] && isset($_GET['p'])) {//добавил проверку $_GET['p'] на существование
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
 * Не обязательным параметром является параметр, показывающий уровень вложенности, на котором мы находимся.
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

// eof
