<?php
/**
 * Date: 31.07.18
 * @author Isaenko Alexey <info@oiplug.com>
 */
require '../../../config.php';
require 'functions.php';

include 'header.php';

$products = [
    [
        'title' => 'Сушеный борщ',
        'name' => 'dry-soup',
        'description' => '',
        'image' => 'borsch.jpg',
        'price' => 200,
        'discount_price' => 99.99,
    ],
    [
        'title' => 'Луковое пирожное',
        'name' => 'onion-sweet',
        'description' => '',
        'image' => 'pirojnoe.jpg',
        'price' => 100,
        'discount_price' => 0,
    ],
    [
        'title' => 'Луковая печенька',
        'name' => 'onion-cookie',
        'description' => '',
        'image' => 'cookies.jpeg',
        'price' => 100,
        'discount_price' => 0,
    ],
    [
        'title' => 'Соленый валенок',
        'name' => 'solt-boot',
        'description' => '',
        'image' => 'valenok.jpg',
        'price' => 250,
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

$out = [];
$order = [];
// 100, 101, 100-1, 100-2

//Так как приписывание к ранее найденному значению "-" (в цикле while) не работает,
// я принял решение прибавлять некое значение заведомо меньшее минимальной разницы между ценами

// поиск наименьшей разницы между значениями цены
$prices = [];
foreach($products as $product){
    $prices[] = $product['price'];
}
$different = [];
for($i = 1; $i < sizeof($prices); $i++){
    $delta = $prices[$i] - $prices[$i-1];
    $different[] = abs($delta);
};
$min_diff = min($different);//наименьшая разница
$accessory_value = $min_diff / 1000;//вспомогательное значение для цикла while

foreach ($products as $product) {
    foreach ($values as $key) {
        if (empty($product[$key])) {
            $product[$key] = '';
        }
    }

    $index = $product['price'];
    while (in_array($index, $order)) {
        $index += 1;
    }
    echo $index.'<br>';
    $order[] = $index;
    $product['image'] = 'assets/images/' . $product['image'];
    $out[$index] = get_template('templates/product', $product);
}

if (!empty($_GET['orderby']) && $_GET['orderby'] == 'price_low') {
    sort($order);
} else {
    rsort($order);
}
$new_out = [];
foreach ($order as $index) {
    $new_out[] = $out[$index];
}

print_r($order);
$out = '<div class="products">' . implode('', $new_out) . '</div>';


$options = [
    'price_low' => 'Сначала низкие',
    'price_hi' => 'Сначала высокие',
];
?>
    <form action="">
        <select name="orderby" id="">
            <?php
            foreach ($options as $key => $value) {
                if (!empty($_GET['orderby']) && $key == $_GET['orderby']) {
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
