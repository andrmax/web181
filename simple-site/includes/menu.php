<?php
/**
 * Date: 16.08.18
 * @author Isaenko Alexey <info@oiplug.com>
 */

$j = 1;

/**
 * рекурсивная функция для вывода меню
 *
 * @param $array
 */
function recursive_for_menu ($array){
	$i = 1;
	global $j;
	/*   if (empty($j)){
		   $j = 1;
	   }*/
	$count = sizeof($array);
	if($j == 1){
		$menu = '<ul class="menu">';
		$out_first ='<li class="button button__first">';
		$out_middle ='<li class="button button__middle">';
		$out_last ='<li class="button button__last">';
		$j++;
		global $j;
	}else{
		$menu = '<ul class="sub__menu">';
		$out_first ='<li class="sub__button">';
		$out_middle = $out_first;
		$out_last = $out_first;
	}
	echo $menu;
	foreach($array as $key => $value){
		if ($i == 1){
			echo $out_first;
			if(!is_array($value)){
				echo $value;
			}else{
				echo $key;
				recursive_for_menu($value);
			}
		}elseif($i == $count){
			;echo $out_last;
			if(!is_array($value)){
				echo $value;
			}else{
				echo $key;
				recursive_for_menu($value);
			}
		}else{
			echo $out_middle;
			if(!is_array($value)){
				echo $value;
			}else{
				echo $key;
				recursive_for_menu($value);
			}
		};
		echo '</li>';
		$i++;
	}echo '</ul>';
}

//функция вывода меню
function menu(){
	//Определяем количество строк где pid=0 (количество кнопок в меню)
	$summ = do_query( 'SELECT COUNT(pid) FROM `menu` WHERE ((pid=0)&&(id!=0))' );
	$mesne_1 = mysqli_fetch_array($summ);
	$count = $mesne_1[0];

	//запрос в БД строк где (pid=0 и id!=0)
	$mesne_2 = do_query( 'SELECT * FROM `menu` WHERE((pid=0)&&(id!=0)) ORDER BY `order` ASC ' );



	//создаем многомерный массив, где имя массивов равно id а его элементы формируются значениями title где pid=id
	$buttons = array();
	while($row = $mesne_2->fetch_assoc()){
		$id = $row['id'];
		$buttons [$row['title']] = array();
		//запрос в БД строк где pid!=0
		$mesne_3 = do_query( 'SELECT * FROM `menu` WHERE(pid!=0) ORDER BY `order` ASC ' );
		while($row_2 = $mesne_3->fetch_assoc()){
			if ($id == $row_2['pid']){

				$buttons [$row['title']][] = $row_2['title'];
			}
		}
	}
	recursive_for_menu($buttons);
}


// eof
