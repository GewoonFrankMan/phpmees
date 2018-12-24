<?php
function dbcon()
{

if (session_status() == PHP_SESSION_NONE) {
session_start();
}
// connection to database ON XAMPP and localhost newdeveloper
$host = "10.0.0.69";
$username = "";
$password = "";
$database = "";
$message = "Database connectie mislukt";
try {
$connect = new PDO("mysql:host=$host; dbname=$database", $username, $password,
array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET sql_mode="TRADITIONAL"')
);
$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
return $connect;
} catch (PDOException $error) {
$message = $error->getMessage();
var_dump($message);
}
}
?>