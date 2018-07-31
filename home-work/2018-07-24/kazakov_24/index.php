<?php

require '../../../config.php';
require 'function.php';
login();
logout();
echo registration();
get_template('form');
// eof