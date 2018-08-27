<?php
global $post;

$post['content'] = str_replace( "\n", '<br>', $post['content'] );
?>
<div class="post">
	<div class="post__title"><?php echo $post['title']; ?></div>
	<div class="post__content"><?php echo $post['content']; ?></div>
	<div class="post__date"><?php echo $post['date']; ?></div>
	<?php
	if ( is_user_logged_in() ) {
		?>
		<div class="post__edit"><a class="post__edit-link" href="?event=edit-post&id=<?php echo $post['id']; ?>"></a>
		</div>
		<?php
	}
	?>
</div>
