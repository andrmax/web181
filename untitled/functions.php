<?php
function lnit(){
    $file = '';
    if (empty($_GET['page'])){
        $file = 'main';
    }else{
        $file = $_GET['page'];
    }
    include 'template/header.php';
    include 'template/menu.php';
    include $file . '.php';
    include 'template/footer.php';
}