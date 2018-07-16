<?php
/**
 * Date: 16.07.2018
 * Zakhar Serkov <zakharserkov@me.com>
 */

/*Задание:
Дан массив $arr. С помощью цикла foreach запишите английские названия в массив $en, а русские - в массив $ru.
*/

$arr = array(
    'green' => 'зеленый',
    'red' => 'красный',
    'blue' => 'голубой'
);
$en = array();
$ru = array();

foreach ($arr as $key => $value) {
    //Раскладываем ключи в массив $en,
    $en[] = $key;
    // а значения в массив $ru
    $ru[] = $arr[$key];
}

echo '<pre>';
print_r($en);
echo '<pre>';

echo '<pre>';
print_r($ru);
echo '<pre>';

// eof