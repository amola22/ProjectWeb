<?php
//database connection parameters
define('HOSTNAME','localhost');
define('USERNAME','root');
define('PASSWORD','');
define('DATABASE','test2');

//connect to database and return connection object

function database_connect(){
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $conn=mysqli_connect(HOSTNAME,USERNAME,PASSWORD,DATABASE);
    return $conn;
}