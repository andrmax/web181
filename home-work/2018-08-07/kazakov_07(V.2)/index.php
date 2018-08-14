<link rel="stylesheet" href="assets/style.css">
<?php
/**
 * Date: 07.08.18
 * @author Isaenko Alexey <info@oiplug.com>
 */
header('Content-Type: text/html; charset=utf-8');
require 'db.php';
require 'functions.php';
//login();
//logout();
prepare_input();//Задание №1. Вызов функции проверки входящих данных
menu();
get_template('form');


// eof
