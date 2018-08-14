<?php

$errors = save_post();
$data   = array(
	'title'   => '',
	'content' => '',
	'from' => '',
	'to' => '',
);
if ( ! empty( $errors ) ) {
	$data = $_POST;
}
echo $errors;
?>
	<form method="post" class="form">
		<input type="text" name="title" value="<?php echo $data['title']; ?>">
		<textarea name="content" id="" cols="30" rows="10"
		          class="form__textarea"><?php echo $data['content']; ?></textarea>
		<button type="submit" class="form__submit">ok</button>
		<input type="hidden" name="save_post" value="1">
	</form>

	<a href="?event=logout">Log out</a>

	<ol>
		<li>Сделать проверку передаваемых данных, чтобы все специальные символы заменялись html-сущностями</li>
		<li>Составьте запрос, чтобы получить n записей, начиная с x</li>
	</ol>
    <div>
    На данный момент в базе <?php echo_counting_rows ();?> записей
    </div>
    <br>
<!--    <form method="post" class="form_for_echo">
        <br>Введите диапазон нужных строк в интервале от 1 до <?php /*echo echo_counting_rows () */?>;
        <div>
            От
            <input type="number" name="from" value="<?php /*echo $data['from']; */?>">
        </div>
        <div>
            До
            <input type="number" name="to" value="<?php /*echo $data['to']; */?>">
        </div>
        <button type="submit" class="form__submit">ok</button>
        <input type="hidden" name="show" value="1">
    </form>-->
<?php

get_posts_from_to();
get_posts();
