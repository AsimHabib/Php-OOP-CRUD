<?php
// Set the credentials for database
$DB_host = "localhost";
$DB_user = "root";
$DB_pass = "dbpass";
$DB_name = "db-php-oop-crud";

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

?>