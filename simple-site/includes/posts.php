<?php
/**
 * Date: 14.08.18
 * @author Isaenko Alexey <info@oiplug.com>
 */

/**
 * Сохранение публикации в бд.
 *
 * @return string
 */
function save_post() {
	if ( ! empty( $_POST['save_post'] ) ) {
		$data = $_POST;

		if ( ! empty( $data['title'] ) && ! empty( $data['content'] ) ) {

			if ( empty( $data['id'] ) ) {
				$query = prepare_insert( array(
					'table'  => 'posts',
					'values' => array(
						'date'    => array(
							'type'  => 'datetime',
							'value' => $data['date']
						),
						'name'   => array(
							'type'  => 'text',
							'value' => $data['title']
						),
						'title'   => array(
							'type'  => 'text',
							'value' => $data['title']
						),
						'content' => array(
							'type'  => 'text',
							'value' => $data['content']
						),
					),
				) );
			} else {
				$query = prepare_update( array(
					'table'  => 'posts',
					'values' => array(
						'date'    => $data['date'],
						'title'   => $data['title'],
						'content' => $data['content'],
					),
					'where'  => array(
						'id' => array(
							'type'  => 'int',
							'value' => $data['id'],
						),
					),
				) );
			}
			//echo $query;
			do_query( $query );

				header( 'location: ?event=post_saved' );
		} else {
			return '<div class="error">Все поля формы должны быть заполнены</div>';
		}
	}

	return '';
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

	return $result;
}

// eof
