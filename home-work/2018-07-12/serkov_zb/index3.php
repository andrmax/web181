<?php
/**
 * Date: 15.07.2018
 * Zakhar Serkov <zakharserkov@me.com>
 */

// Создаем массив
$arr = array(
    'cms' => array('joomla', 'wordpress', 'drupal'),
    'colors' => array(
        'blue' => 'голубой',
        'red' => 'красный',
        'green' => 'зеленый'),
);

/* Выводим на экран нулевое значение из строки 'cms', второе значение из строки 'cms',
значение 'green' из строки 'colors' и значение 'red' из строки 'colors' */
echo $arr ['cms'][0] . ', ' . $arr ['cms'][2] . ', ' . $arr ['colors']['green'] . ', ' . $arr ['colors']['red'] . '.';


// eof