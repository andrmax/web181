<?php
require 'function.php';//подключаем файл с функциями
$array = array();//создаем массив из тысячи рандомных значений
for ($i = 0; $i <=1000; $i++) {
    $array[] = rand(0, 1000);
};
//далее условие: выодим форму если $_POST['numeric'] пуст или резултат поиска (ф-ия time_definition)
if (empty($_POST)){?>
    <h1>Проверка, содержится ли выбранное нами число в массиве из тысячи рандомных значений</h1>
    <form action="" method="post">
        <div class="form form_group">
            <label for="" class="form_label">Введите целое число от 0 до 10000:</label>
            <input type="number" name="numeric" class="form_input" value="<?php echo echo_var('numeric'); ?>">
        </div>
        <button class="form_button">OK</button>
    </form>
<?php }else{
    time_definition($array);
    }