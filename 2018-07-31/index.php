<?php
/**
 * Date: 31.07.18
 * @author Isaenko Alexey <info@oiplug.com>
 */
require '../config.php';
require 'functions.php';

include 'header.php';

$products = [
	[
		'title'          => 'Сушеный борщ',
		'name'           => 'dry-soup',
		'description'    => '',
		'image'          => 'borsch.jpg',
		'price'          => 200,
		'discount_price' => 99.99,
	],
	[
		'title'          => 'Луковое пирожное',
		'name'           => 'onion-sweet',
		'description'    => '',
		'image'          => 'pirojnoe.jpg',
		'price'          => 100,
		'discount_price' => 0,
	],
	[
		'title'          => 'Луковая печенька',
		'name'           => 'onion-cookie',
		'description'    => '',
		'image'          => 'cookies.jpeg',
		'price'          => 100,
		'discount_price' => 0,
	],
	[
		'title'          => 'Соленый валенок',
		'name'           => 'solt-boot',
		'description'    => '',
		'image'          => 'valenok.jpg',
		'price'          => 250,
		'discount_price' => 0,
	],

];

$values = [
	'title',
	'name',
	'description',
	'price',
	'discount_price',
	'image',
];

$out   = [];
$order = [];
// 100, 101, 100-1, 100-2
foreach ( $products as $product ) {
	foreach ( $values as $key ) {
		if ( empty( $product[ $key ] ) ) {
			$product[ $key ] = '';
		}
	}

	$index = $product['price'];
	//echo $index . ' = ' . in_array( $index, $out ).'<br>';
	while ( in_array( $index, $out ) ) {
		$index .= '-';
	}
	$order[]          = $index;
	$product['image'] = 'assets/images/' . $product['image'];
	$out[ $index ]    = get_template( 'templates/product', $product );
}

if ( ! empty( $_GET['orderby'] ) && $_GET['orderby'] == 'price_low' ) {
	sort( $order );
} else {
	rsort( $order );
}
$new_out = [];
foreach ( $order as $index ) {
	$new_out[] = $out[ $index ];
}

print_r( $order );
$out = '<div class="products">' . implode( '', $new_out ) . '</div>';


$options = [
	'price_low' => 'Сначала низкие',
	'price_hi'  => 'Сначала высокие',
];
?>
	<form action="">
		<select name="orderby" id="">
			<?php
			foreach ( $options as $key => $value ) {
				if ( ! empty( $_GET['orderby'] ) && $key == $_GET['orderby'] ) {
					$selected = ' selected';
				} else {
					$selected = '';
				}
				echo '<option value="' . $key . '"' . $selected . '>' . $value . '</option>';
			}
			?>
		</select>
		<button type="submit">OK</button>
	</form>

ДЗ: 1) Сделать сортировку массива с товарами с помощью стандартных функций.
2) Поправить индексацию элементов при сортировке с помощью циклов.
<?php
echo $out;


include 'footer.php';

// eof
