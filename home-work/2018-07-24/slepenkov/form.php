<?php

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
    <style>
        *{
            margin: 0;
            padding: 0;
        }
        form{
            background: #2aabd2;
            padding: 10px;
        }
        input, textarea, button{
            margin: 5px 0;
            display: block;
        }
        .button{
            width: 200px;
        }
        button{
            display: table;
            margin: auto;
            background: tomato;
            color: white;
            line-height: 20px;
            padding: 0 30px;
        }
    </style>
</head>
<body>

<form method="post" class="form">
    <input type="text" name="title" value="<?php echo $data['title']; ?>">
    <textarea name="content" id="" cols="30" rows="10" class="form__textarea"><?php echo $data['content']; ?></textarea>
    <div class="button">
        <button type="submit" class="form__submit">ok</button>
    </div>

    <input type="hidden" name="save_post" value="1">
</form>
</body>
</html>


<?php
get_posts();

?>
