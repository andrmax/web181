<?php
/**
 * Date: 12.07.18
 * @author Isaenko Alexey <info@oiplug.com>
 */
require_once '../config.php';

$arr  = [ 'odin' => 1, 2, ];
$arr2 = array( 'odin' => 3, 4, );

print_r( array_merge( $arr, $arr2 ) );

$f   = fopen( 'file.txt', 'r' );
$out = array();
while ( ! feof( $f ) ) {
	$line  = fgets( $f, 1024 );
	$line  = trim( $line );
	$out[] = "\t" . '<li>' . $line . '</li>';
}

print_r( $out );

$out = implode( "\n", $out );
$out = '<ul>' . "\n" . $out . "\n" . '</ul>';
echo $out;


for ( $i = 1; $i < 10; $i ++ ) {
	echo $i . "\n";
}

// eof
