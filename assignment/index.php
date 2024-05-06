<?php
//config variables


//display error messages caused by PHP
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors',1);

//require or include statement takes all text/code that exists
//in the specified file and copies it into file that uses it
require 'application/mvc.php';
?>