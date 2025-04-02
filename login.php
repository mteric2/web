<?php
session_start();
include("conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = mysqli_real_escape_string($conex, $_POST['correo']);
    $password = $_POST['password'];
    $captcha = $_POST['captcha'];

    if ($captcha != $_SESSION['captcha']) {
        echo "<div class='error'>Error: CAPTCHA incorrecto.</div>";
        header("refresh:3;url=xd.php");
    } else {
        $query = "SELECT * FROM empleados WHERE correo='$correo'";
        $result = mysqli_query($conex, $query);
        $user = mysqli_fetch_assoc($result);

        if ($user && password_verify($password, $user['password_hash'])) {
            $_SESSION['empleado'] = $user['correo'];
            echo "<div class='success'>Inicio de sesión exitoso. <a href='index.html'>INICIO</a></div>";
        } else {
            echo "<div class='error'>Correo o contraseña incorrectos.</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesión</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <div class="login-container">
        <h2>Iniciar sesión</h2>
        <form method="POST">
            <input type="email" name="correo" placeholder="Correo" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <div class="captcha">
                <img src="captcha.php" alt="CAPTCHA">
                <input type="text" name="captcha" placeholder="Ingrese el CAPTCHA" required>
            </div>
            <button type="submit">Iniciar sesión</button>
        </form>
        <a href="editar_password.php">¿Olvidaste tu contraseña?</a>
        <a href="registro.php">Crear una cuenta</a>
    </div>
</body>
</html>
