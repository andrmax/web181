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
        'price' => 100.03,
        'discount_price' => 99.99,
    ],
    [
        'title' => 'Луковое пирожное',
        'name' => 'onion-sweet',
        'description' => '',
        'image' => 'pirojnoe.jpg',
        'price' => 100.04,
        'discount_price' => 0,
    ],
    [
        'title' => 'Луковая печенька',
        'name' => 'onion-cookie',
        'description' => '',
        'image' => 'cookies.jpeg',
        'price' => 100.05,
        'discount_price' => 0,
    ],
    [
        'title' => 'Соленый валенок',
        'name' => 'solt-boot',
        'description' => '',
        'image' => 'valenok.jpg',
        'price' => 100.07,
        'discount_price' => 0,
    ],

];
 //Для реализации сортировки станадартными функциями  выбрал функцию  usort()

//Написал две callback функции для usort()
function cmp_1($data_1, $data_2)//первая callback функция
{
    if ($data_1['price'] == $data_2['price']) {
        return 0;
    }
    return ($data_1['price'] < $data_2['price']) ? -1 : 1;
}

function cmp_2($data_1, $data_2)//вторая callback функция
{
    if ($data_1['price'] == $data_2['price']) {
        return 0;
    }
    return ($data_1['price'] > $data_2['price']) ? -1 : 1;
}

//Сортровка массива $products функцией usort()
if (!empty($_GET['orderby']) && $_GET['orderby'] == 'price_low') {
    usort($products, 'cmp_1');
} else {
    usort($products, 'cmp_2');
}

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

    foreach ($products as $product) {
        foreach ($values as $key) {
            if (empty($product[$key])) {
                $product[$key] = '';
            }
        }
        $product['image'] = 'assets/images/' . $product['image'];
        $out[] = get_template('templates/product', $product);
    }
    $out = '<div class="products">' . implode('', $out) . '</div>';

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