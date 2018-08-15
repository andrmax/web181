<?php
/**
 * Date: 14.08.18
 * @author Isaenko Alexey <info@oiplug.com>
 */

function project_path() {
	return dirname( __FILE__ );

}

function project_url() {
	$project_part = find_http().'://' . $_SERVER['HTTP_HOST'];
	$project_part .= str_replace( $_SERVER['DOCUMENT_ROOT'], '', project_path() );

	return $project_part;
}

/**
 * Функция для определения протокола
 * @return string
 */
function find_http(){
    $out='http';
    if( isset($_SERVER['HTTPS'] ) ) {
        $out='https';
    }
    return $out;
}

/**
 * Функция, содержащая настройки нашей системы
 *
 * @param $what
 *
 * @return array|mixed
 */
function options( $what ) {
	$options = array(
		// указываем количество записей на странице равное 3-м, потому, что нам так хочется
		'limit' => 3,
	);

	if ( ! empty( $what ) ) {
		return $options[ $what ];
	} else {
		return $options;
	}
}

require 'includes/users.php';
require 'includes/posts.php';

function init() {

	if ( empty( $_GET['p'] ) ) {
		$file = 'index';
	} else {
		$file = $_GET['p'];
	}

	get_template( $file );
}

function get_template( $file ) {
	$path = project_path() . '/templates/' . $file . '.php';

	if ( file_exists( $path ) ) {
		include $path;
	}
}

/**
 * Функция для работы с бд.
 *
 * @param $query
 *
 * @return bool|mysqli_result
 */
function do_query( $query ) {
	global $link;

	$result = mysqli_query( $link, $query );

	//print_r( mysqli_error( $link ) );

	return $result;
}

function pagination() {
	if ( ! empty( $_GET['page'] ) ) {
		$page = $_GET['page'];
		if ( 0 > $page ) {
			$page = 1;
		}
	} else {
		$page = 1;
	}
	$result = do_query( 'SELECT COUNT(*) as `count` FROM posts' );
	while ( $row = $result->fetch_assoc() ) {

		// количество записей соответствующих условиям запроса
		$count = $row['count'];
	}

	// кол-во записей, выводимых на странице
	$limit = options( 'limit' );

	// получение кол-ва страниц
	$pages = ceil( $count / $limit );

	$template = '<%tag% class="pagination__item%class%" href="?page=%d%">%caption%</%tag%>';

	$out = array();
	if ( 0 < $page - 1 ) {
		$out[0] = str_replace( '%d%', $page - 1, $template );
		$out[0] = str_replace( '%class%', '', $out[0] );
		$out[0] = str_replace( '%caption%', '<', $out[0] );
		$out[0] = str_replace( '%tag%', 'a', $out[0] );
	}

	for ( $i = 1; $i <= $pages; $i ++ ) {
		if ( $i == $page ) {
			$class = ' active';
			$tag   = 'span';
		} else {
			$class = '';
			$tag   = 'a';
		}
		$out[ $i ] = str_replace( '%d%', $i, $template );
		$out[ $i ] = str_replace( '%caption%', $i, $out[ $i ] );
		$out[ $i ] = str_replace( '%class%', $class, $out[ $i ] );
		$out[ $i ] = str_replace( '%tag%', $tag, $out[ $i ] );
	}

	if ( $pages >= $page + 1 ) {
		$out[ $i ] = str_replace( '%d%', $page + 1, $template );
		$out[ $i ] = str_replace( '%class%', '', $out[ $i ] );
		$out[ $i ] = str_replace( '%caption%', '>', $out[ $i ] );
		$out[ $i ] = str_replace( '%tag%', 'a', $out[ $i ] );
	}

	$out = '<nav><div class="pagination">' . implode( '', $out ) . '</div></nav>';

	echo $out;
}


// eof
