<?php
// Set the credentials for database
/*$DB_host = "localhost";
$DB_user = "root";
$DB_pass = "dbpass";
$DB_name = "db-php-oop-crud";
*/
$DB_host = "db709115212.db.1and1.com";
$DB_user = "dbo709115212";
$DB_pass = "Euro@2017";
$DB_name = "db709115212";


//make a new PDO Connection
try{
    $DB_con = new PDO("mysql:host={$DB_host};dbname={$DB_name}",$DB_user, $DB_pass);
    $DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully"; 
}
catch(PDOException $e)
{
    echo "Connection failed: " . $e->getMessage();
}
/*
// include the Class file and instantiate
include_once 'classes/class.crud.php';
// instantiate or create Calss object
$crud = new CrudClass($DB_con);
*/
?>