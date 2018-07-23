<?php
/**
 * Date: 19.07.18
 * @author Isaenko Alexey <info@oiplug.com>
 */

function get_template( $adds ) {
	$path = 'sections/' . $adds . '.php';
	//print_r($path);
	if ( file_exists( $path ) ) {
		include $path;
	}
}

function construct_page($sections){
	foreach ($sections as $section){
		get_template( $section );
	}
}


function init() {
	include 'templates/header.php';

	$sections = array(
		'top',
		'calculator',
		'call-to-action',
		'bottom',
	);

	construct_page($sections);
	include 'templates/footer.php';
}


// функция на проверку правильности адреса
function filter_mail()
{
    if ( ! empty( $_GET['email'] ) ) {
        $email_a=$_GET['email'];
        if (!(filter_var($email_a, FILTER_VALIDATE_EMAIL))) {
            echo "E-mail адрес '$email_a' указан не верно.\n";
        }
    }


}

// eof
