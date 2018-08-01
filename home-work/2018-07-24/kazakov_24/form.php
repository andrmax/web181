<!-- строки 2-25 перемесил за пределы оператора if так как в противном случае
не работают классы в подключаемых файлах в условии else (стр. 82) -->
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
    <link href="https://fonts.googleapis.com/css?family=Modern+Antiqua" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Amatic+SC" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Underdog" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Neucha" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Iceberg" rel="stylesheet">

</head>
<body>
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
<div class="general">
    <?php
    // Строки 40-52: Реализазция отображения имени и логина вошедшего на странице
    list($login, $password) = explode(';',$_COOKIE['login_password']);
    $content_1 = file_get_contents('users.db');
    $users = explode("\n",$content_1);
    foreach($users as $user){
        list($lgn, $psw, $nm) = explode(';', $user);
        if($lgn == $login && $psw == $password){
            echo '<div>';
            echo '<div class="hello">';
            echo '<div class="subhello_1">Здравствуйте '.$nm.'</div>';
            echo '<div class="subhello_2">Вы вошли как '.$lgn.'</div>';
            echo '</div>';
            echo '</div>';
        }
    }
    ?>
    <!-- В строках 55-73 блоки помещал в другие блоки и писал классы -->
    <form method="post" class="form">
        <div class="over_caption">
            <div class="sign">Тема:</div>
            <div class="caption">
                <input class="sub_caption" type="text" name="title" value="<?php echo $data['title']; ?>">
            </div>
        </div>
        <div class="over_message">
            <div class="sign">Сообщение:</div>
            <div class="message"><textarea class="sub_message" name="content" id="" cols="30" rows="10" class="form__textarea">
                <?php echo $data['content']; ?>
            </textarea></div>
        </div>
        <div class="button">
            <button type="submit" class="form__submit">OK</button>
            <a href="?event=logout">LogOut</a>
        </div>
        <input type="hidden" name="save_post" value="1">
    </form>
    <?php
        get_posts();
    ?>
</div>
<?php
}else{
    echo '<div class="fill">';
    get_template('auth');
    get_template('registration');
    echo '</div>';

}
?>
</body>
</html>
