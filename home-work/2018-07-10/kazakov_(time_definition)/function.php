<?php
function echo_var($name){
    if(!empty($_POST[$name])){
        return $_POST[$name];
    };
    return '';
};

function time_definition($array){//В этой функции двумя способами определяется наличие в массвие введеного значения,
    // а так же время на поиск каждой функцией
    $text = array();
    $time_1 = microtime();
    if (in_array($_POST['numeric'],$array)){//Первый способ поиска
        $time_2 = microtime();
        $result = $time_2 - $time_1;
        $text []= 'Воспользовавшись функцией <b>in_array</b> удалось определить, что число '.$_POST['numeric'].
            ' присутствует в массиве за '.$result.' <br>'."\n";
        /*$recording = file_get_contents('text.txt');
        $string = implode('', $text);
        file_put_contents('text.txt', $recording.$string."\n");*/
    }else{
        $text []= 'Воспользовавшись функцией <b>in_array</b> удалось определить, что число '.$_POST['numeric'].
            ' не содержится в массиве'.' <br>'."\n";
        /*$recording = file_get_contents('text.txt');
        $string = implode('', $text);
        file_put_contents('text.txt', $recording.$string."\n");*/
    };
    $time_1 = microtime();
    foreach($array as $key => $value){//Второй способ поиска
        if($value == $_POST['numeric']){
            $time_2 = microtime();
            $result = $time_2 - $time_1;
            $text []= 'Воспользовавшись функцией <b>foreach</b> удалось определить, что число '.$_POST['numeric'].
                ' присутствует в массиве за '.$result.'<hr>'."\n";
            $recording = file_get_contents('text.txt');
            $string = implode('', $text);
            file_put_contents('text.txt', $recording.$string."\n");
            break;
        }elseif($key == (sizeof($array)-1)){
            $text []= 'Воспользовавшись функцией <b>foreach</b> удалось определить, что число '.$_POST['numeric'].
                ' не содержится в массиве <hr>'."\n";
            $recording = file_get_contents('text.txt');
            $string = implode('', $text);
            file_put_contents('text.txt', $recording.$string."\n");
        };
    };
    $text = implode(' ',$text);
    echo $text;
};
?>
