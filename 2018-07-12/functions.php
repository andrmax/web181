<?php
/**
 * Date: 12.07.18
 * @author Isaenko Alexey <info@oiplug.com>
 */


/**
 * Эта функция выводит данные, которые в нее передают.
 *
 * @param      $text - это передававаемые пользователем данные
 * @param bool $flag
 *
 * @return bool|string
 */
function first( $text, $flag = false ) {

	//
	if ( $flag === true ) {
		$line_break = "\n";

		return $text . $line_break;
	} else {
		$line_break = '';
	}

	return false;

	//echo '!!!!';
}

for ( $i = 0; $i < 10; $i ++ ) {

	$flag = false;
	if ( $i % 3 == 0 ) {
		$flag = true;
	}
	$a = first( 321, $flag );

	if ( $a !== false ) {
		echo $i . ') ' . $a;
	} else {
		echo 'Функция не сработала' . "\n";
	}
}
/*
$a = function () {
	return 'sdf';
};

print_r( $a);*/
// eof
