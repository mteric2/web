<?php
$servername = "localhost";
$database = "vitalverde";
$username = "vitalverde";
$password = "12345";

$conex = mysqli_connect($servername, $username, $password, $database);

if (!$conex) {
    die("Error de conexión: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = mysqli_real_escape_string($conex, $_POST['nombre']);
    $queja = mysqli_real_escape_string($conex, $_POST['queja']);

    $query = "INSERT INTO quejas (nombre, queja) VALUES ('$nombre', '$queja')";
    
    if (mysqli_query($conex, $query)) {
        header("Location: elements.html?success=1"); // Agrega el parámetro
        exit();
    } else {
        header("Location: elements.html?error=1");
        exit();
    }

    mysqli_close($conex);
}
?>
