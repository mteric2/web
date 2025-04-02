<?php
session_start();
include("conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = mysqli_real_escape_string($conex, $_POST['nombre']);
    $correo = mysqli_real_escape_string($conex, $_POST['correo']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $query = "INSERT INTO empleados (nombre, correo, password_hash) VALUES ('$nombre', '$correo', '$password')";

    if (mysqli_query($conex, $query)) {
        echo "<div class='success'>Registro exitoso. <a href='login.php'>Iniciar sesión</a></div>";
    } else {
        echo "<div class='error'>Error: " . mysqli_error($conex) . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <div class="register-container">
        <h2>Crear Cuenta</h2>
        <form method="POST">
            <input type="text" name="nombre" placeholder="Nombre" required>
            <input type="email" name="correo" placeholder="Correo" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <button type="submit">Registrarse</button>
        </form>
        <a href="login.php">¿Ya tienes una cuenta? Inicia sesión</a>
    </div>
</body>
</html>
