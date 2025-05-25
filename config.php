<?php
$host = 'localhost';
$dbname = 'messmangement';
$username = 'postgres';
$password = '1234';


$connection_string = "host=$host dbname=$dbname user=$username password=$password";
$conn = pg_connect("host=localhost dbname=messmangement user=postgres password=1234");

$pdo = pg_connect($connection_string);

if (!$pdo) {
    die("Database connection failed");
}
?>
