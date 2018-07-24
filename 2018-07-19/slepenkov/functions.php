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
function email(){
    $email = "";
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Адрес указан корректно.";
    }else{
        echo "Адрес указан не правильно.";
    }

}
// eof
