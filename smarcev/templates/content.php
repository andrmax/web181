<?php
global $post;
?>
<div class="post">
	<div class="title"><?php echo $post['title']; ?></div>
	<div class="content"><?php echo htmlspecialchars_decode($post['content']); ?></div>
	<div class="date"><?php echo $post['date']; ?></div>
	<?php
	if ( is_user_logged_in() ) {
		?>
		<div class="edit"><a class="edit-link" href="?event=edit-post&id=<?php echo $post['id']; ?>">Редактировать</a>
		</div>
		<?php
	}
	?>
</div>
