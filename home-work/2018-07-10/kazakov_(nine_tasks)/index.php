<link rel="stylesheet" href="vid.css"> <?php //Подключил  файл со стилем ?>

<?php
$arr = [
    'ru'=>['голубой', 'красный', 'зеленый'],
    'en'=>['blue', 'red', 'green'],
];
echo $arr['ru']['0'].'<br><hr>';//1) Выводим на экран слово "голубой"

$arr = ['a'=>1, 'b'=>2, 'c'=>3];
$summ = 0;
foreach($arr as $key => $value){//2) суммируем значения элементов массива
    $summ += $value;
};
echo 'Сумма всех элементов массива равна '.$summ.'<br><hr>';

$arr = [
    'cms'=>['joomla', 'wordpress', 'drupal'],
    'colors'=>['blue'=>'голубой', 'red'=>'красный', 'green'=>'зеленый']
];
//3)
echo $arr['cms'][0].'<br>';//выводим "joomla"
echo $arr['cms'][2].'<br>';//выводим "drupal"
echo $arr['colors']['green'].'<br>';//выводим "зеленый"
echo $arr['colors']['red'].'<br><hr>';//выводим "красный"

for ($i = 0; $i <= 100; $i++){//4) выводим четные числа от 0 до 100
    if ($i % 2 == 0){
        echo $i.'<br>';
    };
};
echo '<hr>';

$arr = array(0, 1,);
for ($i = 2; $i <= 20; $i++){//5) Создаем массив из значений представляющих собой последовательность Фибоначчи
    $arr[$i] = $arr[$i-2] + $arr[$i-1];
};
$out = implode(', ', $arr);
echo 'Последовательность Фибоначчи из 20 чисел: '.$out.'<br><hr>';

for ($i = 0; $i <= 100; $i++){//6) Выводим числа от 0 до 100 в 4 столбца
    echo '<div class="vid">'.$i.'</div>';
    if (($i +  1) % 4 == 0){
        echo '<br>';
    };
};
echo '<br><hr>';

$ru = array();//7) Ключи являющиеся английскими словами запишем в массив $en, русские значения- в $ru
$en = array();
$arr = ['green'=>'зеленый', 'red'=>'красный', 'blue'=>'голубой'];
foreach($arr as $key => $value){
    $ru[] = $value;
    $en[] = $key;
};
print_r($ru);
echo '<br>';
print_r($en);
echo '<br><hr>';

$arr = array('10', '20', '30', '50', '235', '3000',);//8) выводим только те значения, которые начинаются с цифр 1, 2, 5
foreach ($arr as $value){
    $numeric = substr($value,0, 1);
    $arr_2 = array(1, 2, 5,);
    if (in_array($numeric, $arr_2)) {
        echo $value.' ';
    };
};
echo '<br><hr>';

$num = 1000;// узнаем сколько раз нужно поделить 1000 на 2 чтоб получить первое значение меньше 50
for ($i = 0, $result = $num; $result >= 50; $i++){
    $result = $result/2;
};
echo 'При делении '.$num.' на 2 '.$i.' раз получено число '.$result.'<br><hr>';