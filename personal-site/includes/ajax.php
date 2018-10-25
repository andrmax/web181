<?php
/**
 * Date: 23.10.18
 * @author Isaenko Alexey <info@oiplug.com>
 */

include '../functions.php';

function send_json_success( $data = null ) {
	$data = json_encode( array(
		'success' => true,
		'data'    => $data,
	) );

	echo $data;
	die();
}

function send_json_error( $data= null ) {
	$data = json_encode( array(
		'success' => false,
		'data'    => $data,
	) );

	echo $data;
	die();
}


function update_profile() {
	if ( ! empty( $_REQUEST ) ) {
		$data = $_REQUEST;

		$fields = fields_profile();
		$error  = array();
		foreach ( $fields as $key => $value ) {
			if ( ! empty( $value['required'] ) && empty( $data[ $key ] ) ) {
				$error[] = 'Поле "' . $value['label'] . '" должно быть заполнено!';
			}
		}

		if ( ! empty( $error ) ) {
			send_json_error( $error );

		}else{

			send_json_success();
		}


	}
}

function ajax_request() {
	if ( ! empty( $_REQUEST['action'] ) && function_exists( $_REQUEST['action'] ) ) {

		$_REQUEST['action']();
	}

	echo 0;
}

ajax_request();


// eof
