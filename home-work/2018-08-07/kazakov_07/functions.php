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

function prepare_insert( $query ) {
	/*$query = array(
		'table'  => '',
		'values' => array(
			'title'   => '',
			'content' => '',
		),
	);*/
/*print_r($query);*/
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

function get_posts() {

	$result = do_query( 'SELECT * FROM posts ORDER BY `date` DESC LIMIT 3' );

	while ( $row = $result->fetch_assoc() ) {
		echo '<div class="post">'
		     . '<div class="title">' . $row['title'] . '</div>'
		     . '<div class="content">' . $row['content'] . '</div>'
		     . '<div class="date">' . $row['date'] . '</div>'
		     . '</div>'
		     . '';
	}
}

function echo_counting_rows (){
    $i = 0;
    $result = do_query( 'SELECT * FROM posts ORDER BY `date`' );
    while ($row = $result->fetch_assoc()){
        $i++;
    }
    $out = 'Число строк в posts- '.$i;
    echo $out;
}

function get_posts_from_to(){
    $result = do_query( 'SELECT * FROM posts ORDER BY `date`' );
    $i =0;
    while ($row = $result->fetch_assoc()){
        $i++;
    }
    if (!empty($_POST['show'])&&$_POST['show']=='1'){
        $data = $_POST;
        if(($data['from'] > $i)||($data['to'] > $i)||($data['from'] > $data['to'])){
            echo 'Указан не корректный диапазон';
        }else{
            $i =0;
            $result = do_query( 'SELECT * FROM posts ORDER BY `date`' );
            while ($row = $result->fetch_assoc()){
                $i++;
                if(($i >= $data['from'])&& ($i <= $data['to'])){
                    echo '<div class="post">'
                        . '<div class="title">' . $row['title'] . '</div>'
                        . '<div class="content">' . $row['content'] . '</div>'
                        . '<div class="date">' . $row['date'] . '</div>'
                        . '</div>';
                }
            }
        }
    }
//    header('location: ?');
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
