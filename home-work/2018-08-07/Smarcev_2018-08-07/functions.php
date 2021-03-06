<?php
/**
 * Date: 26.07.18
 * @author Isaenko Alexey <info@oiplug.com>
 */

function get_template($adds)
{
    $path = $adds . '.php';
    //print_r($path);
    if (file_exists($path)) {
        include $path;
    }
}

function prepare_insert($query)
{
    /*$query = array(
        'table'  => '',
        'values' => array(
            'title'   => '',
            'content' => '',
        ),
    );*/
    print_r($query);
    $query_string = array(array(), array());
    foreach ($query['values'] as $key => $value) {
        $query_string[0][] = $key;
        $value = htmlentities($value);
        $query_string[1][] = "'$value'";
    }

    $query_string[0] = implode(',', $query_string[0]);
    $query_string[1] = implode(',', $query_string[1]);

    $query = 'INSERT INTO ' . $query['table'] . ' (' . $query_string[0] . ') VALUES (' . $query_string[1] . ')';
    echo $query;

    return $query;
}

function save_post()
{
    if (!empty($_POST['save_post'])) {
        $data = $_POST;

        if (!empty($data['title']) && !empty($data['content'])) {

            $query = prepare_insert(array(
                'table' => 'posts',
                'values' => array(
                    'title' => $data['title'],
                    'content' => $data['content'],
                ),
            ));

            do_query($query);

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
function options($what)
{
    $options = array(
        // указываем количество записей на странице равное 3-м, потому, что нам так хочется
        'limit' => 3,
    );

    if (!empty($what)) {
        return $options[$what];
    } else {
        return $options;
    }
}

function get_posts()
{

    if (!empty($_GET['page'])) {
        $page = $_GET['page'];
        if (0 > $page) {
            $page = 1;
        }
    } else {
        $page = 1;
    }


    $limit = options('limit');
    $offset = $limit * ($page - 1);

    $result = do_query('SELECT * FROM posts ORDER BY `date` DESC LIMIT ' . $limit . ' OFFSET ' . $offset);

    while ($row = $result->fetch_assoc()) {
        echo '<div class="post">'
            . '<div class="title">' . $row['title'] . '</div>'
            . '<div class="content">' . $row['content'] . '</div>'
            . '<div class="date">' . $row['date'] . '</div>'
            . '</div>'
            . '';
    }
}

function pagination()
{
    if (!empty($_GET['page'])) {
        $page = $_GET['page'];
        if (0 > $page) {
            $page = 1;
        }
    } else {
        $page = 1;
    }
    $result = do_query('SELECT COUNT(*) as `count` FROM posts');
    while ($row = $result->fetch_assoc()) {

        // количество записей соответствующих условиям запроса
        $count = $row['count'];
    }

    // кол-во записей, выводимых на странице
    $limit = options('limit');

    // получение кол-ва страниц
    $pages = ceil($count / $limit);

    $template = '<%tag% class="pagination__item%class%" href="?page=%d%">%caption%</%tag%>';

    $out = array();
    if (0 < $page - 2) {
        $out[0] = str_replace('%d%', 1, $template);
        $out[0] = str_replace('%class%', '', $out[0]);
        $out[0] = str_replace('%caption%', '<<', $out[0]);
        $out[0] = str_replace('%tag%', 'a', $out[0]);
    }


    if (0 < $page - 1) {
        $out[1] = str_replace('%d%', $page - 1, $template);
        $out[1] = str_replace('%class%', '', $out[1]);
        $out[1] = str_replace('%caption%', '<', $out[1]);
        $out[1] = str_replace('%tag%', 'a', $out[1]);
    }
    if ($page >= 4 && $pages >= 7 && $page <= $pages-3) {
        $pg = 7;
        $i_pg = $page - 3;
    } elseif ($page >= 4 && $pages >= $page) {
        $pg = 4 + $pages - $page;
        $i_pg = $page - 3;
    } elseif ($page < 4 && $pages >= 7) {
        $pg = $page + 3;
        $i_pg = 1;
    } else {
        $pg = $pages;
        $i_pg = 1;
    }
   // echo '<div>' . $pages . '<br>' . $page . '<br>' . $pg . '<br>' . $i_pg . '</div>';

    for ($i = 2; $i <= $pg + 1; $i++) {
        if ($i_pg + $i - 2 == $page) {
            $class = ' active';
            $tag = 'span';
        } else {
            $class = '';
            $tag = 'a';
        }
        $out[$i] = str_replace('%d%', $i_pg + $i - 2, $template);
        $out[$i] = str_replace('%caption%', $i_pg + $i - 2, $out[$i]);
        $out[$i] = str_replace('%class%', $class, $out[$i]);
        $out[$i] = str_replace('%tag%', $tag, $out[$i]);
    }

    if ($pages >= $page + 1) {
        $out[$i] = str_replace('%d%', $page + 1, $template);
        $out[$i] = str_replace('%class%', '', $out[$i]);
        $out[$i] = str_replace('%caption%', '>', $out[$i]);
        $out[$i] = str_replace('%tag%', 'a', $out[$i]);
    }
    if ($pages >= $page + 2) {
        $out[$i + 1] = str_replace('%d%', $pages, $template);
        $out[$i + 1] = str_replace('%class%', '', $out[$i + 1]);
        $out[$i + 1] = str_replace('%caption%', '>>', $out[$i + 1]);
        $out[$i + 1] = str_replace('%tag%', 'a', $out[$i + 1]);
    }
    $out = '<nav><div class="pagination">' . implode('', $out) . '</div></nav>';

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


function do_query($query)
{
    global $link;

    $result = mysqli_query($link, $query);
    print_r(mysqli_error($link));

    return $result;
}


// eof
