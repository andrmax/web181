<?php
/**
 * Date: 10.07.18
 * @author Isaenko Alexey <info@oiplug.com>
 */

require_once '../config.php';

$array = array( 'Митрофан', 'чувак' => 'Жорж', 'Афоня' );

foreach ( $array as $i => $item ) {
	echo $i . ') ' . $item . ', ';
}

echo '<hr>';

$array2 = [ 'a', 34, $array, '!!!', '???' ];

// перебор массива
foreach ( $array2 as $value ) {

	// если элемент не является массивом
	if ( ! is_array( $value ) ) {
		echo $value;
	} else {
		//print_r( $value );
		foreach ( $value as $i => $item ) {
			echo ( $i + 1 ) . ') ' . $item . ', ';
		}
	}
}

$array_1 = [
	'a_2_1' => [
		'a_3_1' => [
			'a_4' => [ 'a', 'b', 'c', ],
		],
		'a_3_2' => [
			'a_4_1' => [ 'a', 'b', 'c', ],
			'a_4_2' => [ 'a', 'b', 'c', ],
			'a_4_3' => [ 'a', 'b', 'c', ],
		],
		'a_3_3' => [
			'a_4' => [ 'a', 'b', 'c', ],
		],
	],
	'a_2_2' => [
		'a_3_1' => [
			'a_4' => [ 'a', 'b', 'c', ],
		],
		'a_3_2' => [
			'a_4' => [ 'a', 'b', 'c', ],
		],
		'a_3_3' => [
			'a_4' => [ 'a', 'b', 'c', ],
		],
	],
	'a_2_3' => [
		'a_3_1' => [
			'a_4' => [ 'a', 'b', 'c', ],
		],
		'a_3_2' => [
			'a_4' => [ 'a', 'b', 'c', ],
		],
		'a_3_3' => [
			'a_4' => [ 'a', 'b', 'c', ],
		],
	],
];

print_r( $array_1 );


$array = array(
	'белорус' => 'Митрофан',
	'еврей'   => 'Жорж',
	'русский' => 'Афоня'
);

echo '<hr>';
echo $array['белорус'];

foreach ( $array as $i => $item ) {
	echo $i . ') ' . $item . ', ';
}

$data = [
	'pair'    => 'USD-BTC',
	'price'   => 6350,
	'buy'     => 14,
	'sell'    => 20,
	'av_buy'  => 6400,
	'av_sell' => 6700,
];
print_r( $data );
echo 'пара ' . $data['pair'] . ' торгуется по цене ' . $data['price'] . '$';
echo '<hr>';
print_r( implode( ', ', array_keys( $data ) ) );




// eof
