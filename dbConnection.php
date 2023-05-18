<?php
$databaseHost = 'localhost';
$databaseName = 'hotel';
$databaseUsername = 'root';
$databasePassword = '';

$mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);

if($mysqli === false){
    die("Connection failed: " .  mysqli_connect_error());
}
?>