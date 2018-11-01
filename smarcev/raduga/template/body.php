<h3>Задача: используя PHP и JS создать страницу, на которой при выборе пользователем цветов будет меняться цветовое отображение (радуга)</h3>
<div class="php_f">Использование PHP</div>
<?php
/**
 * Created by PhpStorm.
 * User: mixdior
 * Date: 27.10.2018
 * Time: 9:05
 */

//присваивание переменной массива цветов
$arr=array(
    "red"=>"red",
    "blue"=>"blue",
    "green"=>"green"
);
$str=3; // количество строк радуги
//print_r($arr);
?>
<!--Все в форму методом post и присваиваем id-->
<form class="colors" id="cf__f" method="post">

<?php
//если переменна POST пуста, т.е. в самом начале открытия страницв
if (empty($_POST)){
    //цикл для присваивания перемнной $color значений цветов
    foreach ($arr as $value){
        $color[]=$value;
    }
    //цикл загрузки радуги, начиная с 1
for ($i = 1; $i <= $str; $i++) {
//вывод списка радуги с цветами
    echo div_color($i, $arr, $color[$i-1], "cf__f");
}
}
//события на нажатие кнопки
if (isset($_POST['button_cf'])) {
//цикл загрузки радуги, начиная с 1
    for ($i = 1; $i <= $str; $i++) {
        //переменная для выбора значения select
        $key='colors__select'.$i;
        //присваиваем переменной значение из select, которая хранится в переменной post
        $value_color[$i] = $_POST[$key];
        //вывод строки с цветом
        echo div_color($i,$arr,$value_color[$i],"cf__f");
    }

   //print_r($_POST);
}
?>
    <button name="button_cf">Raduga</button>
</form>








