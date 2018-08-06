<?php
/**
 * Date: 31.07.18
 * @author Isaenko Alexey <info@oiplug.com>
 */

function get_template( $adds, $data = array() ) {
	$path = $adds . '.php';
	$out = '';
	if ( file_exists( $path ) ) {
		ob_start();
		include $path;
		$out = ob_get_clean();
	}

	return $out;
}
// eof
