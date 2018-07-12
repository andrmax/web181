<?php

//Чтение строки из файла
/*
$handle = fopen("users.txt", "r");

if ($handle) {
    while (($buffer = fgets($handle, 4096)) !== false) {
        echo $buffer;
    }
    if (!feof($handle)) {
        echo "Ошибка: fgets() неожиданно потерпел неудачу\n";
    }
    fclose($handle);
}
*/
// Получает содержимое файла в виде массива.
$lines = file('users.txt');
$n_k=10;//необходимое количество элементов
$str_a=array(); //новый массив с n_k последними строками
$f_s=sizeof($lines); //количество элементов в массиве
//условие на количество элементов в файле, если меньше 10 то показываем весь файл
if ($f_s<=$n_k) { 
		$str_a=$lines();
	}

	//если количество элементов больше 10 запускаем беребор массива
	elseif ($f_s>=$n_k) {
		foreach ($lines as $line_num => $line) {

//когда достигается массив конец-n_k элементов, то записывается новый массив
if ( $line_num >= $f_s-$n_k) {
	$str_a[] = $lines[$line_num];
}
   }

   // вариант 2: упрощенный цикл - берем прям последние элементы
$str_a2=array();
   for ($i=$f_s-$n_k; $i<=$f_s ; $i++) { 
   	$str_a2[] = $lines[$i];
   }
	}



echo implode(" ",$str_a);
echo "</br>";
echo implode(" ",$str_a2);


 
?>