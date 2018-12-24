<?php
function dbcon()
{

if (session_status() == PHP_SESSION_NONE) {
session_start();
}
// connection to database ON XAMPP and localhost newdeveloper
$host = "";
$username = "";
$password = "";
$database = "";
$error = "database connectie is gefaalt";
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