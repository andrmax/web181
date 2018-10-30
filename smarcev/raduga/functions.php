<?php
/**
 * Created by PhpStorm.
 * User: mixdior
 * Date: 27.10.2018
 * Time: 11:05
 */
// Функция для формирования списка цветов для тега select
function color_edit($arr,$color_f){
    //цикл для по массиву цветов
    foreach ($arr as $value) {
        //Если заданный цвет равен элементу списка массива
        if ($value==$color_f) {
            //собираем список из значений массива цветов и выделяем выбранный цвет
            $option_value[] = '<option selected value="'.$value.'">' . $value . '</option>';
        }else {
            //собираем список из значений массива цветов
            $option_value[] = '<option value="'.$value.'">' . $value . '</option>';;
        }
    }
    //print_r($option_value);
    $option_value_ob=implode("",$option_value);
    //print_r($option_value_ob);
    return $option_value_ob;
}

/*
 * Функция для определения form
 * */
function div_color($col, $arr,$color_f,$id_form){
    //цикл для создания тегов div в количестве $col с тегапи option, формируемыми функцией color_edit
        $div_punkt="<div class=\"colors__first cf__".$color_f."\">".$col."<select class=\"colors__select\" 
        name=\"colors__select".$col."\" form=\"".$id_form."\">".color_edit($arr, $color_f) ."</select></div>";
    //print_r($div_punkt_ob);
    return $div_punkt;
}



//eof