<?php
function portus() {
    if ( ! empty( $_GET['page'] ) ) {
        $p = $_GET['page'];
    } else {
        $p = 'main';
    }

    include 'header.php';

    include 'menu.php';

    if ( ! file_exists( $p . '.php' ) ) {
        $p = '404';
    }
    include $p . '.php';

    include 'footer.php';
}

function menu($data) {

    $out = array();
    foreach ( $data as $key => $item ) {
        $out[] = '<li class="menu__item"><a class="menu__link" href="?page=' . $key . '">' . $item['caption'] . '</a></li>';
    }

    $out = implode( "\n", $out );

    $out = '<div class="menu">'
        .'<ul class="menu__list">'
        . $out . '</ul></div>';

    return $out;
}

function get_template($name){
    if(file_exists($name.'.php')){
        include $name.'.php';
    }
}


function is_sidebar(){
    if(file_exists( 'sidebar.php')){
        return 'sidebar_exists';
    }

    return '';
}