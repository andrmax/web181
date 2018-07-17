<?php
/**
 * Date: 05.07.18
 * @author Isaenko Alexey <info@oiplug.com>
 */

$arr = [
    'ru'=>['голубой', 'красный', 'зеленый'],
    'en'=>['blue', 'red', 'green'],
];
echo  $arr['ru'][0]; //вывод элемента массива
echo "<hr>";

$arr2 = ['a'=>1, 'b'=>2, 'c'=>3];
$summ = array_sum($arr2); //функция суммирования элементов массива
echo $summ;
echo "<hr>";

$arr3 = [
    'cms'=>['joomla', 'wordpress', 'drupal'],
    'colors'=>['blue'=>'голубой', 'red'=>'красный', 'green'=>'зеленый']
];
echo $arr3['cms'][0].', ';
echo $arr3['cms'][2].', ';
echo $arr3['colors']['green'].', ';
echo $arr3['colors']['red'].', '; //вывод необходимых элементов
echo "<hr>";

for ($i = 0; $i <= 100; $i++){ //цикл от нуля до ста
    if ($i%2 == 0){echo $i.'<br>';} //проверка на четность и вывод в столбец
}
echo "<hr>";

$arr4 = array();
$a = 0;
$b = 1;
for ($i = 0; $i < 10; $i++) { //цикл от 1 до 10
    $arr4[]=$a;  //добавляем первую переменную в массив
    $a = $a+$b; // считаем следующее число ряда
    $arr4[]=$b; //добавляем вторую переменную в массив
    $b = $a+$b; // считаем следующее число ряда
}
echo "<pre>";
print_r($arr4); //вывод массива
echo "</pre>";
echo "<hr>";

for ($i=1; $i<=100; $i++) {
    echo $i.'  ';
    $i++;
    echo $i.'  ';
    $i++;
    echo $i.'  ';
    $i++;
    echo $i."<br>";
}
echo "<hr>";


$arr5 = ['green'=>'зеленый', 'red'=>'красный', 'blue'=>'голубой'];
$en=[];
$ru=[];
foreach ($arr5 as $key => $value) {
    $en[]=$key; //добавляем $key в массив en
    $ru[]=$value; //добавляем $value в массив ru
}
echo "<pre>";
print_r($en);
echo "</pre>";
echo "<pre>";
print_r($ru);
echo "</pre>";
echo "<hr>";

$arr6 = ['10', '20', '30', '50', '235', '3000'];
foreach ($arr6 as $value) {
    $numm = substr($value, 0, 1); // в переменную numm отправляем первое число из переменной value
    if ($numm == 1 || 3 || 5) {   // если переменная numm равна 1 или 3 или 5 выводим ///Такая запись не сработала, можете объяснить почему?
        echo $value.' ';
    }
}
echo "<hr>";

$num=1000;
$n=1; //кол-во итераций
while ($num>50) { //условие: если num больше 50 цикл продолжает работать
    $num= $num/2; //деление на 2
    $n++;
}
echo 'После '.$n.' итераций переменная $num стала равняться '.$num;