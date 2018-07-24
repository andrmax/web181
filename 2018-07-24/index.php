<?php
/**
 * Date: 24.07.18
 * @author Isaenko Alexey <info@oiplug.com>
 */

require '../config.php';

function save_post() {
	if ( ! empty( $_POST['save_post'] ) ) {
		$data = $_POST;

		if ( ! empty( $data['title'] ) && ! empty( $data['content'] ) ) {
			/*$data = $data['title']
			        . ';'
			        . $data['content'];*/

			$data = json_encode( $data );
			file_put_contents( 'blog/' . date( 'Y-m-d-H-i-s' ) . '.txt', $data );
			header( 'location: ?event=post_saved' );
		} else {
			return '<div class="error">Все поля формы должны быть заполнены</div>';
		}
	}

	return '';
}

function get_posts() {
	$files = scandir( 'blog' );

	rsort( $files );

	foreach ( $files as $date ) {
		if ( '.' != $date && '..' != $date ) {
			$file_content = file_get_contents( 'blog/' . $date );
			$data         = explode( ';', $file_content );

			// todo: преобразование строки содержащей дату в привычный формат: 1) преобразовать строку в timestamp 2) преобразовать timestamp в привычный формат даты

			/*$date = str_replace( '.txt', '', $date );
			$out  = '<div class="post">'
			        . '<div class="post__date">' . $date . '</div>'
			        . '<div class="post__title">' . $data[0] . '</div>'
			        . '<div class="post__content">' . $data[1] . '</div>'
			        . '</div>';*/
			//echo $out;

			$file_content = json_decode( $file_content, true );
			if ( is_array( $file_content ) ) {
				print_r( $file_content );
			} else {
				echo '<div>' . $file_content . '</div>';
			}

		}
	}
}


include 'form.php';

// eof
