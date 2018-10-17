<?php
/**
 * Date: 09.10.18
 * @author Isaenko Alexey <info@oiplug.com>
 */

function get_geo_data() {
	if ( ! empty( $_REQUEST ) && ! empty( $_REQUEST['address'] ) ) {
		$data = $_REQUEST;
if(empty($data['format'])){
	$data['format'] = 'json';
}
		$data['address'] = 'Россия, Москва, '.$data['address'];
		$data = file_get_contents( 'https://geocode-maps.yandex.ru/1.x/?geocode=' . $data['address'] . '&format=' . $data['format'] . '' );

		echo $data;
		die();
	}
}

get_geo_data();
// eof
