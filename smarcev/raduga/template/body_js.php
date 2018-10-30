
<div class="js_isp">Использование JS</div>
<form class="colors" id="cf__fjs" method="post">

<?php

    //цикл для присваивания перемнной $color значений цветов
    foreach ($arr as $value) {
        $color[] = $value;
    }
    //цикл загрузки радуги, начиная с 1
    for ($i = 1; $i <= $str; $i++) {
//вывод списка радуги с цветами
        echo div_color($i, $arr, $color[$i - 1],"cf__fjs");

}

?>



</form>
