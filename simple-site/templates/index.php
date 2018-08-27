<?php
/**
 * Date: 14.08.18
 * @author Isaenko Alexey <info@oiplug.com>
 */
global $post;
the_template( 'header' );

// получение публикаций из БД
$posts = get_posts();

// если публикации есть
if ( ! empty( $posts ) ) {

	// вывод меню
	menu();
	//phpinfo();
	?>
	<div class="container">
		<?php
		// вывод публикаций
		while ( $post = $posts->fetch_assoc() ) {

			$post['date'] = date( 'H:i, d.m.Y', strtotime( $post['date'] ) );

			the_template( 'content' );
		}
		?>
	</div>
	<?php
	// постраничная навигация по публикациям
	pagination();
}

the_template( 'footer' );

// eof
