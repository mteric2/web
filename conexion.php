<?php
$servername = "localhost";
$database = "vitalverde";
$username = "vitalverde";
$password = "12345";

$conex = mysqli_connect($servername, $username, $password, $database);

if (!$conex) {
    die("Error de conexión: " . mysqli_connect_error());
}
?>
