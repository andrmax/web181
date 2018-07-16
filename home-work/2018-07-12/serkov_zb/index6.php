<?php
/**
 * Date: 15.07.2018
 * Zakhar Serkov <zakharserkov@me.com>
 */
// Создаем массив и наполняем его значениями от 0 до 100
$array = range(1, 100);

// Считаем количество элементов в массиве $array и делим на 4
$n = sizeof($array) / 4;
$col_1 = array_chunk($array, $n) [0];
$col_2 = array_chunk($array, $n) [1];
$col_3 = array_chunk($array, $n) [2];
$col_4 = array_chunk($array, $n) [3];

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css"
          integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
    <title>2018-07-12 / 6</title>
</head>
<body>
<div class="row">
    <div class="col-3">
        <?php
        // Выводим в колонке на экран значения массива
        foreach($col_1 as $value)
        {
            echo "$value <br />";
        }
        ?>
    </div>
    <div class="col-3">
        <?php
        foreach($col_2 as $value)
        {
            echo "$value <br />";
        }
        ?>
    </div>
    <div class="col-3">
        <?php
        foreach($col_3 as $value)
        {
            echo "$value <br />";
        }
        ?>
    </div>
    <div class="col-3">
        <?php
        foreach($col_4 as $value)
        {
            echo "$value <br />";
        }
        ?>
    </div>
</div>


</body>
</html>