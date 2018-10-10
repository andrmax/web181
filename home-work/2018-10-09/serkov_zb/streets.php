<?php
/**
 * Date: 09.10.18
 * @author Isaenko Alexey <info@oiplug.com>
 */


function get_streets($url) {
    if (!empty($_GET['address'])) {
        $address = $_GET['address'];
    }
    $streets = file_get_contents($url);
    //print_r($streets);
    preg_match_all('/<a.*?href=street.asp\?street=[0-9]{1,4}>(.*?)<\/a/si', $streets, $matches);

    //print_r($matches);
    $matches = explode( "^", iconv( 'Windows-1251', 'UTF-8', implode( "^", $matches[1] ) ) );
    print_r( $matches );

    echo json_encode($matches);
    die();
}

//get_streets( 'http://mosopen.ru/district/uao/streets' );
get_streets('http://moo2.ru/streetalf.asp?letter=244');
// eof
