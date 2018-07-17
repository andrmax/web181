<?php
/**
 * Date: 15.07.2018
 * Zakhar Serkov <zakharserkov@me.com>
 */

/*Задание:
Создайте массив $arr. Найдите сумму элементов этого массива.
*/
// Создаем массив
$arr = array(
    'a' => 1,
    'b' => 2,
    'c' => 3,
);

// Складываем элементы "a", "b" и "c" массива $arr
echo $arr['a'] + $arr['b'] + $arr['c'];

echo '<hr>';

// Суммируем элементы массива $arr с помощью функции array_sum и выводим результат на экран
echo array_sum($arr);

echo '<hr>';

// eof