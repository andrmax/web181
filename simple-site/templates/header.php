<!doctype html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
	      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>
	<link rel="stylesheet" href="<?php echo project_url(); ?>/asstets/styles/style.css">
</head>
<body>
<div class="top-bar">
	<div class="top-bar__container">
<?php

// если пользователь авторизован
if ( is_user_logged_in() !== true ) {
	echo registration();
	the_template( 'registration' );
	the_template( 'auth' );
} else {
?>

		<a class="button" href="?event=edit-post">Добавить запись</a>
		<a class="button" href="?event=logout">Выход</a>
		<?php

		$date = implode( 'T', explode( ' ', date( 'Y-m-d H:i' ) ) );


		if ( ! empty( $_GET['event'] ) && 'edit-post' == $_GET['event'] ) {
			if ( ! empty( $_GET['id'] ) ) {
				$result       = do_query( 'SELECT * FROM posts WHERE id = ' . $_GET['id'] );
				$i            = 0;
				$data         = $result->fetch_assoc();
				$data['date'] = str_replace( ' ', 'T', $data['date'] );
				/*$data = array(
					'date'    => $date,
					'title'   => '',
					'content' => '',
					'id'      => 0,
				);*/
			} else {
				$data = array(
					'date'    => $date,
					'title'   => '',
					'content' => '',
					'id'      => 0,
				);
			}
			the_template( 'post-edit', $data );
		}
		}
		?>
	</div>
</div>

