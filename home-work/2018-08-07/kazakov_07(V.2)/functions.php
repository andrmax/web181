<?php
/**
 * Date: 26.07.18
 * @author Isaenko Alexey <info@oiplug.com>
 */

function get_template( $adds ) {
	$path = $adds . '.php';
	//print_r($path);
	if ( file_exists( $path ) ) {
		include $path;
	}
}

//Задание №1. Функция проверки передаваемых данных, чтобы все специальные символы заменялись html-сущностями
function prepare_input(){
    if (!empty($_POST)){
        foreach($_POST as $key => $value){
            /*$value = htmlspecialchars($value);*/
            $value = htmlentities($value);
            $value = strip_tags($value);
            $value = trim($value);
            $value = stripcslashes($value);
            $_POST[$key] = $value;
        }
    }return $_POST;
}
//Задание №2. Функция вывода Х записей начиная с N
function specified_output(){
    if((!empty($_POST['spec_out'])) && ($_POST['spec_out'] = '1')){
        $data = $_POST;
        echo '<div class="spec_out">';
        echo 'Вывод '.$data['strings'].' записей начиная с '.$data['from'].'<br><br>';
        $result = do_query( 'SELECT * FROM posts ORDER BY `date` DESC LIMIT ' . $data['strings'] . ' OFFSET ' . ($data['from']-1) );
            while ( $row = $result->fetch_assoc() ) {
                echo '<div class="post">'
                    . '<div class="title">' . $row['title'] . '</div>'
                    . '<div class="content">' . $row['content'] . '</div>'
                    . '<div class="date">' . $row['date'] . '</div>'
                    . '</div>';
            }
        echo '</div>';

    }
    echo '<br>';
}

function menu(){
    //Определяем количество строк где pid=0
    $summ = do_query( 'SELECT COUNT(pid) FROM `menu` WHERE ((pid=0)&&(id!=0))' );
    $mesne_1 = mysqli_fetch_array($summ);
    $count = $mesne_1[0];

    $mesne_2 = do_query( 'SELECT * FROM `menu` WHERE((pid=0)&&(id!=0)) ORDER BY `order` ASC ' );
    echo '<div class="menu">';
    $j= 1;
    $template = '<%div% class="button button__%first%">'.$row['title'].'</div>';
    while ($row = $mesne_2->fetch_assoc()){
        if ($j == 1){
            echo '<div class="button button__first">'.$row['title'].'</div>';
        }elseif($j == $count){
            echo '<div class="button button__last">'.$row['title'].'</div>';
        }else{
            echo '<div class="button button__middle">'.$row['title'].'</div>';
        };
        $j++;
    }
    echo '</div>';
}

function prepare_insert( $query ) {
	/*$query = array(
		'table'  => '',
		'values' => array(
			'title'   => '',
			'content' => '',
		),
	);*/
	print_r( $query );
	$query_string = array( array(), array() );
	foreach ( $query['values'] as $key => $value ) {
		$query_string[0][] = $key;
		$value             = htmlspecialchars( $value );
		$query_string[1][] = "'$value'";
	}

	$query_string[0] = implode( ',', $query_string[0] );
	$query_string[1] = implode( ',', $query_string[1] );

	$query = 'INSERT INTO ' . $query['table'] . ' (' . $query_string[0] . ') VALUES (' . $query_string[1] . ')';
	echo $query;

	return $query;
}

function save_post() {
	if ( ! empty( $_POST['save_post'] ) ) {
		$data = $_POST;

		if ( ! empty( $data['title'] ) && ! empty( $data['content'] ) ) {

			$query = prepare_insert( array(
				'table'  => 'posts',
				'values' => array(
					'title'   => $data['title'],
					'content' => $data['content'],
				),
			) );

			do_query( $query );

			//header( 'location: ?event=post_saved' );
		} else {
			return '<div class="error">Все поля формы должны быть заполнены</div>';
		}
	}

	return '';
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

function get_posts() {

	if ( ! empty( $_GET['page'] ) ) {
		$page = $_GET['page'];
		if ( 0 > $page ) {
			$page = 1;
		}
	} else {
		$page = 1;
	}


	$limit  = options( 'limit' );
	$offset = $limit * ( $page - 1 );

	$result = do_query( 'SELECT * FROM posts ORDER BY `date` DESC LIMIT ' . $limit . ' OFFSET ' . $offset );

	while ( $row = $result->fetch_assoc() ) {
		echo '<div class="post">'
		     . '<div class="title">' . $row['title'] . '</div>'
		     . '<div class="content">' . $row['content'] . '</div>'
		     . '<div class="date">' . $row['date'] . '</div>'
		     . '</div>'
		     . '';
	}
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

	//Задание №3. Определение числа записей в posts функцией php
	$result = do_query( 'SELECT COUNT(*) FROM posts' );
	$mesne = mysqli_fetch_array($result);
    $count = $mesne[0];

	// кол-во записей, выводимых на странице
	$limit = options( 'limit' );

	// получение кол-ва страниц
	$pages = ceil( $count / $limit );

	$template = '<%tag% class="pagination__item%class%" href="?page=%d%">%caption%</%tag%>';

	$out = array();

	//Задание №4. В целом в строках 170-215 пришлось поменять ключи в $out

    //Задание №4. Кнопка перехода на первую страницу
    if ( 0 < $page - 1 ) {
        $out[0] = str_replace( '%d%', 1, $template );
        $out[0] = str_replace( '%class%', '', $out[0] );
        $out[0] = str_replace( '%caption%', '<<', $out[0] );
        $out[0] = str_replace( '%tag%', 'a', $out[0] );
    }

	if ( 0 < $page - 1 ) {
		$out[1] = str_replace( '%d%', $page - 1, $template );
		$out[1] = str_replace( '%class%', '', $out[1] );
		$out[1] = str_replace( '%caption%', '<', $out[1] );
		$out[1] = str_replace( '%tag%', 'a', $out[1] );
	}

	for ( $i = 2; ($i-1) <= $pages; $i ++ ) {
		if ( ($i-1) == $page ) {
			$class = ' active';
			$tag   = 'span';
		} else {
			$class = '';
			$tag   = 'a';
		}
		if((($i-1) >= ($page - 3))&&(($i-1) <= ($page + 3))){
            $out[ $i ] = str_replace( '%d%', $i-1, $template );
            $out[ $i ] = str_replace( '%caption%', $i-1, $out[ $i ] );
            $out[ $i ] = str_replace( '%class%', $class, $out[ $i ] );
            $out[ $i ] = str_replace( '%tag%', $tag, $out[ $i ] );
        }
	}

	if ( $pages >= $page + 1 ) {
		$out[ $i ] = str_replace( '%d%', $page + 1, $template );
		$out[ $i ] = str_replace( '%class%', '', $out[ $i ] );
		$out[ $i ] = str_replace( '%caption%', '>', $out[ $i ] );
		$out[ $i ] = str_replace( '%tag%', 'a', $out[ $i ] );
	}


    //Задание №4. Кнопка перехода на последнюю страницу
    if ( $pages >= $page + 1 ) {
        $out[ $i+1 ] = str_replace( '%d%', $pages, $template );
        $out[ $i+1 ] = str_replace( '%class%', '', $out[ $i+1 ] );
        $out[ $i+1 ] = str_replace( '%caption%', '>>', $out[ $i+1 ] );
        $out[ $i+1 ] = str_replace( '%tag%', 'a', $out[ $i+1 ] );
    }

	$out = '<nav><div class="pagination">' . implode( '', $out ) . '</div></nav>';

	echo $out;
}


/**
 * Проверка, является ли пользователь авторизованным
 * Проверка производится на соответсвие данных в куках данным в файле users.db
 *
 * @return bool
 */
/*function is_user_logged_in() {
	if ( ! empty( $_COOKIE['login_password'] ) ) {
		list( $login, $password ) = explode( ';', $_COOKIE['login_password'] );
	}


	if ( ! empty( $login ) && ! empty( $password ) ) {
		$users = file_get_contents( 'users.db' );
		$users = explode( "\n", $users );
		foreach ( $users as $user ) {
			list( $log, $pass ) = explode( ';', $user );

			if ( $log == $login && $pass == $password ) {
				return true;
			}
		}
	}

	return false;
}

function get_hash( $string ) {
	return md5( $string . 'f5a823476b0bbc09a66cec6020176c93' );
}

function login() {
	if ( ! empty( $_POST['event'] ) && $_POST['event'] == 'login' ) {
		$data = $_POST;

		setcookie( 'login_password',
			$data['login']
			. ';'
			. get_hash( $data['password'] ),
			time() + 3600,
			'/' );
		header( 'location: ?' );
	}
}

function logout() {
	if ( ! empty( $_GET['event'] ) && $_GET['event'] == 'logout' ) {
		print_r( $_GET );

		setcookie( 'login_password', '',
			time() - 24 * 3600, '/' );
		header( 'location: ?' );
	}
}


function registration() {
	$out = '';
	if ( ! empty( $_POST['event'] ) && $_POST['event'] == 'registration' ) {
		$data = $_POST;
		$file = file_get_contents( 'users.db' );

		$users = explode( "\n", $file );
		foreach ( $users as $user ) {
			list( $log ) =
				explode( ';', $user );

			if ( $log == $data['login'] ) {
				$out = 'Пользователь с указанным логином уже существует!';

				return $out;
			}
		}

		$file .= $data['login'] . ';' . get_hash( $data['password'] ) . "\n";
		file_put_contents( 'users.db', $file );

		setcookie( 'login_password',
			$data['login']
			. ';'
			. get_hash( $data['password'] ),
			time() + 3600,
			'/' );
		header( 'location: ?' );
	}

	return $out;
}*/


function do_query( $query ) {
	global $link;

	$result = mysqli_query( $link, $query );
	print_r( mysqli_error( $link ) );

	return $result;
}


// eof
