<?php
/**
 * Date: 26.07.18
 * @author Isaenko Alexey <info@oiplug.com>
 */

function get_template($adds)
{
    $path = $adds . '.php';
    //print_r($path);
    if (file_exists($path)) {
        include $path;
    }
}

/**
 * @return string
 * Функция для записи логина и пароля в файл, если нажата клавиша ок.
 */

function save_post()
{


    if (!empty($_POST['save_post'])) { //Если не пустое передано значение переменной , т.е. идет отрабатывание формы
        $data = $_POST; //записываем в переменную дата значения из глобальной переменной пост
        print_r($data);
        if (!empty($data['title']) && !empty($data['content'])) { //проверяется значение название поста и контент, если данные значения имеются то проводим запись
            /*$data = $data['title']
                    . ';'
                    . $data['content'];*/

            $data = json_encode($data); // перекодируем знаяение переменной в джейсон
            file_put_contents('blog/' . date('Y-m-d-H-i-s') . '.txt', $data); //создаем файл в папке блог с наименованием дата-время с расширением txt
            header('location: ?event=post_saved');  //переводим страницу по ссылке
        } else {
            return '<div class="error">Все поля формы должны быть заполнены</div>';  //будет передано значение для вывода - ошибка
        }
    }

    return '';//возвращаем пустое значение, ошибки не будет
}

function get_posts()
{
    $files = scandir('blog', 1);//Получает список файлов и каталогов, расположенных по указанному пути

    //rsort( $files );

    foreach ($files as $date) {
        if ('.' != $date && '..' != $date) {
            $file_content = file_get_contents('blog/' . $date);
            $data = explode(';', $file_content);

            // todo: преобразование строки содержащей дату в привычный формат:
            // todo: 1) преобразовать строку в timestamp
            // todo: 2) преобразовать timestamp в привычный формат даты

            /*$date = str_replace( '.txt', '', $date );
            $out  = '<div class="post">'
                    . '<div class="post__date">' . $date . '</div>'
                    . '<div class="post__title">' . $data[0] . '</div>'
                    . '<div class="post__content">' . $data[1] . '</div>'
                    . '</div>';*/
            //echo $out;

            $file_content = json_decode($file_content, true);
            if (is_array($file_content)) {
                print_r($file_content);
            } else {
                //echo '<div>' . $file_content . '</div>';
            }

        }
    }
}

/**
 * Проверка, является ли пользователь авторизованным
 * Проверка производится на соответсвие данных в куках данным в файле users.db
 *
 * @return bool
 */

/**
 * @return bool
 * Если в куки есть логин и пароль, то начинаем с ними работать
 */
function is_user_logged_in()
{

    if (!empty($_COOKIE['login_password'])) {
        list($login, $password) = explode(';', $_COOKIE['login_password']); //заносим логин и пароль в переменные
    }


    if (!empty($login) && !empty($password)) { //проверяем условие на непустое значение логина и пароля
      //  echo '<div>Привет ' . $login . '</div>';
        //echo '<div>'.$login.'<br>'.$password.'</div>';
        //$users = file_get_contents('users.db'); //открываем файл
        $users = fopen('users.db', 'r'); //открываем файл
        while (($str = fgets($users, 4096)) !== false) {
            list($log, $pass) = explode(';', $str);
           // echo '<div>'.$log.'<br>'.$pass.'</div>';
           // echo '<div><br>r='.intval($pass).' = '.intval($password).'</br></div>';

            if (($log == $login) && intval($pass)==intval($password)) { //сравнимаем полученное значение из куки со значениями из файла
                echo '<div class="hello"><h1><br>Привет:'.$login.'</h1></div>';
                return true;

            }
            /* $users = explode("\n", $users);//заносим построчное значение из файла в массив
             foreach ($users as $user) { //работа с полученным массивом
                 list($log, $pass) = explode(';', $user); //разбиваем каждую строчку массива на логин и пароль

                 if ($log == $login && $pass == $password) { //сравнимаем полученное значение из куки со значениями из файла
                 }
                 return true; //если значения совпали, то возвращаем истина
             }
         } else {
             echo '<div>Пользователь с логином: ' . $login . ' не существует или Вы ввели неверно пароль</div>';
             return false; //если пароль или логин не совпал, то указываем ложь и передаем значение
         }*/
        }
    echo '<div>Пользователь с логином: ' . $login . ' не существует или Вы ввели неверно пароль</div>';
        return false; //если пароль или логин не совпал, то указываем ложь и передаем значение
    }
}


function get_hash($string)
{
    return md5($string . 'f5a823476b0bbc09a66cec6020176c93');
}

/**
 *
 *Проверка - есть ли в переменной Post значение - нажата ли клавиша login.
 * Если есть, то заносим данные значения в куки
 */

function login()
{
    if (!empty($_POST['event']) && $_POST['event'] == 'login') {
        $data = $_POST;

        setcookie('login_password',
            $data['login']
            . ';'
            . get_hash($data['password']),
            time() + 3600,
            '/');
        header('location: ?');
    }
}

/**
 * Проверка, нажата ли ссылка Logout. Если нажата, то стираем из куки значения логина
 * и пароля
 */
function logout()
{
    if (!empty($_GET['event']) && $_GET['event'] == 'logout') {
        print_r($_GET);

        setcookie('login_password', '',
            time() - 24 * 3600, '/');
        header('location: ?');
    }
}


/**
 * @return string
 * Регистрация нового пользователя
 */

function registration()
{
    $out = '';
    if (!empty($_POST['event']) && $_POST['event'] == 'registration') { //если получено значение переменной пост как регистрация
        $data = $_POST; //заносим данные в переменную дата
        //$file = file_get_contents('users.db'); //открываем файл с паролями
        $file = fopen('users.db', 'r');
        while (($str = fgets($file, 4096)) !== false) {


            list($log) =
                explode(';', $str);

            if ($log == $data['login']) { //если логин совпал, то пользователя не регистрируем и в переменную записываем сообщение
                $out = 'Пользователь с указанным логином уже существует!';
                fclose($file);
                return $out; //передаем значение переменной
            } else {
                fclose($file);
                $data_file = $data['login'] . ';' . get_hash($data['password']) . "\n";
                file_put_contents('users.db', $data_file, FILE_APPEND);
            }
        }
        /* $users = explode("\n", $file);//в переменную записываем массив, состоящий из строк файла
         foreach ($users as $user) { //перебираем массив иразделяем логин и пароль
             list($log) =
                 explode(';', $user);

             if ($log == $data['login']) { //если логин совпал, то пользователя не регистрируем и в переменную записываем сообщение
                 $out = 'Пользователь с указанным логином уже существует!';

                 return $out; //передаем значение переменной
             }
         }

         $file .= $data['login'] . ';' . get_hash($data['password']) . "\n";//если логина не существует, то в перемнную файл записываем логин и хэш-пароль
         file_put_contents('users.db', $file); //открываем файл для записи и дозаписываем строчку */

        setcookie('login_password', //добавляем куки
            $data['login']
            . ';'
            . get_hash($data['password']),
            time() + 3600,
            '/');
        header('location: ?'); //переводим страницу
    }

    return $out; //возвращаем значение переменной аут
}

function open_file($file_name, $string)
{

//ng=explode(';',$string);

//Поочередно получаем строки и проверяем соответствие
    $descriptor = fopen($file_name, 'r');
    if ($descriptor) {
        while ($str = fgets($descriptor, 4096) !== false) {
            echo($str);
            if ($string == $str) {
                print_r($str);
                print_r($string);
                return true;
            } else {
                return false;
            }
        }


    }
    fclose($descriptor);
}

// eof
