<?php
/**
 * Date: 14.08.18
 * @author Isaenko Alexey <info@oiplug.com>
 */

function project_path() {
	return dirname( __FILE__ );
}

function project_url() {
	$project_part = 'http://' . $_SERVER['HTTP_HOST'];
	$project_part .= str_replace( $_SERVER['DOCUMENT_ROOT'], '', project_path() );

	return $project_part;
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

require_once 'includes/users.php';
require_once 'includes/menu.php';
require_once 'includes/posts.php';

/**
 * Функция начала работы
 *
 */

function init() {

	if ( empty( $_GET['p'] ) ) { /*Если пустая глобальная переменная в строке, то
 загружаем страницу index*/
		$file = 'index';
	} else {
		$file = $_GET['p'];
	}

	logout();
	login();
	save_post();


	the_template( $file );
}

/**
 * Получение шалона с передачей в него переменной с ключами.
 *
 * @param       $file
 * @param array $data
 *
 * @return string
 */
function get_template( $file, $data = array() ) {
	$path = project_path() . '/templates/' . $file . '.php';

	$out = '';
	if ( file_exists( $path ) ) {
		ob_start();
		include $path;
		$out = ob_get_clean();
	}

	return $out;
}

/**
 * Вывод шаблона с учетом переданных в него данных.
 *
 * @param       $file
 * @param array $data
 */
function the_template( $file, $data = array() ) {
	echo get_template( $file, $data );
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


function prepare_insert( $query ) {
	/*$query = array(
		'table'  => '',
		'values' => array(
			'title'   => '',
			'content' => '',
		),
		'id' => array(
			'type'  => 'int',
			'value' => $data['id'],
		),
	);*/
	print_r( $query );
	$query_string = array( array(), array() );
	foreach ( $query['values'] as $key => $value ) {
		$value['value'] = htmlspecialchars( $value['value'] );
		switch ( $value['type'] ) {
			case 'datetime':
				$value['value'] = str_replace( 'T', ' ', $value['value'] );
				$value['value'] = "'{$value['value']}'";
				break;
			case 'text':
				$value['value'] = "'{$value['value']}'";
				break;
		}
		$query_string[0][] = $key;
		$query_string[1][] = $value['value'];
	}

	$query_string[0] = implode( ',', $query_string[0] );
	$query_string[1] = implode( ',', $query_string[1] );

	$query = 'INSERT INTO ' . $query['table'] . ' (' . $query_string[0] . ') VALUES (' . $query_string[1] . ')';
	echo $query;

	return $query;
}

function prepare_update( $query ) {
	/*$query        = array(
		'table'  => '',
		'values' => array(
			'title'   => '',
			'content' => '',
		),
		'id' => array(
			'type'  => 'int',
			'value' => $data['id'],
		),
	);*/
	$query_string = array();
	foreach ( $query['values'] as $key => $value ) {
		$value          = htmlspecialchars(nl2br( $value ));
		$query_string[] = $key . '="' . $value . '"';
	}

	$condition = array();
	foreach ( $query['where'] as $key => $value ) {
		if ( 'int' == $value['type'] ) {
			$condition[] = $key . '=' . $value['value'];
		} else {
			$condition[] = $key . '="' . $value['value'] . '"';
		}

	}

	$condition    = implode( ' AND ', $condition );
	$query_string = implode( ', ', $query_string );

	$query = 'UPDATE ' . $query['table'] . ' SET ' . $query_string . ' WHERE ' . $condition;


	return $query;
}
/*function new_post() {
    if ( ! empty( $_GET['event'] ) && $_GET['event'] == 'new_post' ) {
        the_template ('post');
        header( 'location: ?' );
    }
}*/
// Транслитерация строк.
function rus2translit($string) {
    $converter = array(
        'а' => 'a',   'б' => 'b',   'в' => 'v',
        'г' => 'g',   'д' => 'd',   'е' => 'e',
        'ё' => 'e',   'ж' => 'zh',  'з' => 'z',
        'и' => 'i',   'й' => 'y',   'к' => 'k',
        'л' => 'l',   'м' => 'm',   'н' => 'n',
        'о' => 'o',   'п' => 'p',   'р' => 'r',
        'с' => 's',   'т' => 't',   'у' => 'u',
        'ф' => 'f',   'х' => 'h',   'ц' => 'c',
        'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',
        'ь' => '\'',  'ы' => 'y',   'ъ' => '\'',
        'э' => 'e',   'ю' => 'yu',  'я' => 'ya',

        'А' => 'A',   'Б' => 'B',   'В' => 'V',
        'Г' => 'G',   'Д' => 'D',   'Е' => 'E',
        'Ё' => 'E',   'Ж' => 'Zh',  'З' => 'Z',
        'И' => 'I',   'Й' => 'Y',   'К' => 'K',
        'Л' => 'L',   'М' => 'M',   'Н' => 'N',
        'О' => 'O',   'П' => 'P',   'Р' => 'R',
        'С' => 'S',   'Т' => 'T',   'У' => 'U',
        'Ф' => 'F',   'Х' => 'H',   'Ц' => 'C',
        'Ч' => 'Ch',  'Ш' => 'Sh',  'Щ' => 'Sch',
        'Ь' => '\'',  'Ы' => 'Y',   'Ъ' => '\'',
        'Э' => 'E',   'Ю' => 'Yu',  'Я' => 'Ya',
    );
    return strtr($string, $converter);
}
function str2url($str) {
    // переводим в транслит
    $str = rus2translit($str);
    // в нижний регистр
    $str = strtolower($str);
    // заменям все ненужное нам на "-"
    $str = preg_replace('~[^-a-z0-9_]+~u', '-', $str);
    // удаляем начальные и конечные '-'
    $str = trim($str, "-");
    return $str;
}




// eof
