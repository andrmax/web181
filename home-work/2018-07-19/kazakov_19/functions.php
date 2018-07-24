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

function check_mail(){
   if($_POST['mail'] == ''){
   }else{
       $mail = filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL);
       if ($mail == $_POST['mail']){
           echo 'На указанный E-mail будет отправлена брощюра';
       }else{
           echo 'Указанный E-mail не корректен';
       };
   };
};

function echo_val() {
    if (empty($_POST['mail'])){
        $_POST['mail'] = '';
    };
    echo $_POST['mail'];
};
// eof