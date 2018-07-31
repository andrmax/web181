<?php
if(is_user_logged_in()){
$errors = save_post();
$data   = array(
	'title'   => '',
	'content' => '',
);
if ( ! empty( $errors ) ) {
	$data = $_POST;
}
echo $errors;
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">

    <!-- Ниже подключены шрифты из GOOGLE -->
    <link href="https://fonts.googleapis.com/css?family=Caveat" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Audiowide" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Pattaya" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Jura" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">

</head>
<body>
<div class="general">
    <form method="post" class="form">
        <div class="over_caption">
            <div class="sign">Тема:</div>
            <div class="caption">
                <input class="sub_caption" type="text" name="title" value="<?php echo $data['title']; ?>">
            </div>
        </div>
        <div class="over_message">
            <div class="sign">Сообщение:</div>
            <textarea class="sub_message" name="content" id="" cols="30" rows="10" class="form__textarea">
                <?php echo $data['content']; ?>
            </textarea>
        </div>
        <div class="button">
            <button type="submit" class="form__submit">OK</button>
        </div>
        <input type="hidden" name="save_post" value="1">
    </form>
    <a href="?event=logout">LogOut</a>
    <?php
        get_posts();
    ?>
</div>
<?php
}else{
    get_template('auth');
    get_template('registration');
}
?>
</body>
</html>
