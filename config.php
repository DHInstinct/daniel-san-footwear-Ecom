<?php

/*

    //config.php will include all global variables, database connection, and any site wide requirements.


*/
 // Database Connection
 define('DB_HOST', 'localhost');
 define('DB_USER', 'CIT410S21');
 define('DB_PASS', 'This1sAS3cr3t!');
 define('DB_DB', 'cit410s21');

 //database connection
 @$db = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_DB);

 //Check for connection error
 if (mysqli_connect_errno()){
     echo "Database Connection Issue";
     exit();
 }

    





?>