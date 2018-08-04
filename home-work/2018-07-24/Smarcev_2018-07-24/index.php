<?php
/**
 * Date: 24.07.18
 * @author Isaenko Alexey <info@oiplug.com>
 */

require '../config.php';
require 'functions.php';
get_template('header');
login();
logout();
get_template('form');
get_template('footer');

// eof
