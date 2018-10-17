<?php
/**
 * Date: 04.10.18
 * @author Isaenko Alexey <info@oiplug.com>
 */

if ( ! empty( $_GET['post_id'] ) ) {
	$post_id = $_GET['post_id'];
}

if ( 13 == $post_id ) {
	$array = array(
		'title' => 'Новый заголовок',
		'date'  => date( 'H:i:s, d.m.Y' ),
	);
} else {
	$array = array(
		'title' => 'Совершенно другая публикация',
		'date'  => date( 'H:i:s, d.m.Y' ),
	);
}


if ( ! empty( $_GET['text'] ) ) {
	$array['mydata'] = $_GET['text'];
}

$array = json_encode( $array );

echo $array;

die();

// ДЗ: создать аналогичный файл, в котором в зависимости от передаваемых из JS параметров будут возвращеные различные данные.
// Написать в js функцию, которая делает запрос к вашему php файлу

// eof
