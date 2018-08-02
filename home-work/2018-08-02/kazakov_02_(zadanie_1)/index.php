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
    //При выполнении ДЗ, а именно: "Поправить индексацию элементов при сортировке с помощью
    //циклов" пришел к выводу, что изменить повторяющийся ключ добавлением строчных
    //элементов типа "-" не получится, так как ключи содержащие число будут
    //преобразованы в тип integer ('100-' преобразуется снова в 100), прибавление
    //дробной части к ключу даст тот же эффект (float преобразуется в integer, 100.001 преобразуется в 100).
    //Кроме того, если цены будут отличаться только цифрами после запятой, то использоваание цены в
    //качестве индекса, приведет к тому что получим набор одних и тех же индексов.
    //Так как маловероятно, что число знаков после запятой в цене будет больше двух, при создании
    //ключей (для сортировки) может сначала помножить цену на 1000, а потом использовать как ключ.
    //Если и после этого некторые цены остаются одинаковыми, то вот тогда  в цикле while
    //будем прибавлять единицу к повторяющемуся значению (обеспечив запас прибавлений к
    //повторяющимся значениям максимум 10 раз).
    $index = $product['price']*1000;
    while (in_array($index, $order)) {
        $index += 1;
    }
    $order[] = $index;
    $product['image'] = 'assets/images/' . $product['image'];
    $out[$index] = get_template('templates/product', $product);
}

if (!empty($_GET['orderby']) && $_GET['orderby'] == 'price_low') {
    sort($order );
} else {
    rsort($order);
}
$new_out = [];
foreach ($order as $index) {
    $new_out[] = $out[$index];
}

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
