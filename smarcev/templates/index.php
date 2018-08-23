<?php
/**
 * Date: 14.08.18
 * @author Isaenko Alexey <info@oiplug.com>
 */
global $post;
the_template( 'header' );

$posts = get_posts();
if ( ! empty( $posts ) ) {


	if ( is_user_logged_in() !== true ) {
		echo registration();
		the_template( 'registration' );
		the_template( 'auth' );
	} else {
		?>
        <div>
		<a href="?event=logout">Log out</a>
        </div>
        <div>
        <a href="?event=new_post">New post</a>
        </div>
		<?php

        if ( ! empty( $_GET['event'] ) && $_GET['event'] == 'new_post' ) {
            $data = array(
                'date'    => implode( 'T', explode( ' ', date( 'Y-m-d H:i' ) ) ),
                'title'   => '',
                'content' => ''
            );
            the_template ('post',$data);
            //header( 'location: ?' );
        }

		$date = implode( 'T', explode( ' ', date( 'Y-m-d H:i' ) ) );


		if ( ! empty( $_GET['event'] ) && 'edit-post' == $_GET['event'] ) {
			if ( ! empty( $_GET['id'] ) ) {
				$result       = do_query( 'SELECT * FROM posts WHERE id = ' . $_GET['id'] );
				$i            = 0;
				$data         = $result->fetch_assoc();
				$data['content']=str_replace ("<br />", "",htmlspecialchars_decode($data['content']));
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
	menu();
	//phpinfo();
	while ( $post = $posts->fetch_assoc() ) {
		the_template( 'content' );
	}
	pagination();
}

the_template( 'footer' );

// eof
