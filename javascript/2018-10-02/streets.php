<?php
/**
 * Date: 09.10.18
 * @author Isaenko Alexey <info@oiplug.com>
 */


function get_streets( $url ) {
	if ( ! empty( $_GET['address'] ) ) {
		$address = $_GET['address'];
	}
	$out       = '';
	$hash      = md5( $url );
	$file_name = 'cache/' . $hash . '.txt';

	if ( ! file_exists( $file_name ) ) {
		$streets = file_get_contents( $url );
		//print_r($streets);
		preg_match_all( '/<a.*?href=street.asp\?street=[0-9]{1,5}>(.*?)<\/a/si', $streets, $matches );

		// к каждому элементу массива применяем функцию конвертации в utf-8
		$matches[1] = array_map( function ( $text ) {
			return iconv( 'windows-1251', 'UTF-8', $text );
		}, $matches[1] );

		$out = json_encode( $matches[1], JSON_UNESCAPED_UNICODE );
		file_put_contents( $file_name, $out );
	} else {
		$out = file_get_contents( $file_name );
	}

	// отменяем эскейпы для кириллицы
	echo $out;

	die();
}

//get_streets( 'http://mosopen.ru/district/uao/streets' );
get_streets( 'http://moo2.ru/streetalf.asp?letter=244' );

/**
 * 1. Оптимизировать запросы к серверу - если введена 1 буква - делать запрос и помещать результат в переменную, если введено более 1-й буквы, осуществлять поиск по имеющемуся результату
 * 2. Спарсить страницу http://moo2.ru/street_text.shtml и сохранить все улицы москвы на жестком диске6 чтобы в последствии не обращаться к удаленному серверу
 */

// eof
