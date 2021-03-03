<?php

/*

    config.php will include all global variables, and any site wide requirements.


*/
 // Database Connection
 define('DB_HOST', 'cit.marshall.edu');
 define('DB_USER', 'CIT410S21');
 define('DB_PASS', 'This1sAS3cr3t!');
 define('DB_NAME', 'cit410s21');

 //Error report
 define('SEND_ERRORS_TO', 'hartley47@marshall.edu');
 //change to false when turning in
 define( 'DISPLAY_DEBUG', true);



 spl_autoload_register(function ($class) {
    require "classes/" . $class . "_class.php";
});







?>