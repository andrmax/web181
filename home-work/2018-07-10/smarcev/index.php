<?php
/**
 * Date: 10.07.18
 * @author Isaenko Alexey <info@oiplug.com>
 */

require_once '../config.php';

$array = array ( 'Митрофан', 'чувак' => 'Жорж', 'Афоня' );

foreach ( $array as $i => $item ) {
	echo $i . ') ' . $item . ', ';
}

echo '<hr>';

$array2 = array ( 'a', 34, $array, '!!!', '???' );

// перебор массива
foreach ( $array2 as $value ) {

	// если элемент не является массивом
	if ( ! is_array ( $value ) ) {
		echo $value;
	} else {
		//print_r( $value );
		foreach ( $value as $i => $item ) {
			echo ( $i + 1 ) . ') ' . $item . ', ';
		}
	}
}

$array_1 = array (
	'a_2_1' => array (
		'a_3_1' => array (
			'a_4' => array ( 'a', 'b', 'c', ),
		),
		'a_3_2' => array (
			'a_4_1' => array ( 'a', 'b', 'c', ),
			'a_4_2' => array ( 'a', 'b', 'c', ),
			'a_4_3' => array ( 'a', 'b', 'c', ),
		),
		'a_3_3' => array (
			'a_4' => array ( 'a', 'b', 'c', ),
		),
	),
	'a_2_2' => array (
		'a_3_1' => array (
			'a_4' => array ( 'a', 'b', 'c', ),
		),
		'a_3_2' => array (
			'a_4' => array ( 'a', 'b', 'c', ),
		),
		'a_3_3' => array (
			'a_4' => array ( 'a', 'b', 'c', ),
		),
	),
	'a_2_3' => array (
		'a_3_1' => array (
			'a_4' => array ( 'a', 'b', 'c', ),
		),
		'a_3_2' => array (
			'a_4' => array ( 'a', 'b', 'c', ),
		),
		'a_3_3' => array (
			'a_4' => array ( 'a', 'b', 'c', ),
		),
	),
);

print_r( $array_1 );


$array = array (
	'белорус' => 'Митрофан',
	'еврей'   => 'Жорж',
	'русский' => 'Афоня'
);

echo '<hr>';
echo $array['белорус'];

foreach ( $array as $i => $item ) {
	echo $i . ') ' . $item . ', ';
}

$data = array (
	'pair'    => 'USD-BTC',
	'price'   => 6350,
	'buy'     => 14,
	'sell'    => 20,
	'av_buy'  => 6400,
	'av_sell' => 6700,
);
print_r( $data );
echo 'пара ' . $data['pair'] . ' торгуется по цене ' . $data['price'] . '$';
echo '<hr>';
print_r( implode( ', ', array_keys( $data ) ) );


$array = array (
	'Митрофан', // 0
	'Жорж', // 1
	'Афоня', // 2
	'Женя',
	'Тихомир',
	'Ярополк',
	'Ослябе',
	'Пересвет',
	'Яхонт',
	'Янис',
	'Федот',
	'Крамол',
	'Крит',
	'Ярополк',
);

/*
1) Взять массив и собрать второй массив, котором элементы расположены в обратном поряке

Чтобы получить индекс последнего элемента, надо - из числа элементов массива вычесть единицу!


*/





$array2 = array ();
$n      = sizeof( $array );
// перебор массива в обратном порядке
for ( $i = $n - 1; $i >= 0; $i -- ) {

	//
	if ( $i % 2 == 0 ) {
		$array2[] = $array[$i];
	}
}

$name = 'Ярополк';
echo '<hr>';

/*
1. Создать массив, состаящий из 1000 случайных чисел от 1 до 1000
2. Узнать присутствует ли в сформированном массиве число Х
3. Понять, какой из 2-х методов работает быстрее.
*/


echo in_array ( $name, $array );


foreach ( $array as $value ) {
	if ( $name == $value ) {
		echo '<div>Да, ' . $name . ' в списке!</div>';
		break;
	}
}

echo '<hr>';
print_r( $array );
print_r( $array2 );


//Массив из 1000 случайных элементов
// Создаем массив из 1000 элементов
$array_3 = array();
echo '<div>';
for ($i=0; $i < 1000; $i++) { 
	$array_3[$i] = rand(0, 100);
	echo ' '.$array_3[$i];
}

//Поиск числа
$n = 25;
foreach ($array_3 as $key => $value) {
	if ($array_3[$key] = $n) {
		echo '<div>В массиве встречается число '.$array_3[$key].'</div>';
		break;
	}
}

//Метод for составить массив из каждого второго элемента
$i=1;
$array_4 = array();
foreach ($array_3 as $key => $value) {
	if ($key == $i) {
		$array_4=$array_3[$key];
		$i=$i+2;
		echo '<div>'.$array_4.'</div>';
	}
}
 // Измерение выполнение функции
$start = microtime(true); //начало измерения
$array_5 = array();
$n_el=1000000;
for ($i=0; $i < $n_el; $i++) { 
	$array_5[$i] = rand();
}

$end = microtime(true); //конец измерения

echo 'Время выполнения из '.$n_el.' элементов: '.($end - $start); //вывод результата
// eof
