<?php
include("conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = mysqli_real_escape_string($conex, $_POST['correo']);
    $query = "SELECT * FROM empleados WHERE correo='$correo'";
    $result = mysqli_query($conex, $query);

    if (mysqli_num_rows($result) > 0) {
        $nuevaPassword = substr(md5(time()), 0, 8);
        $passwordHash = password_hash($nuevaPassword, PASSWORD_BCRYPT);
        mysqli_query($conex, "UPDATE empleados SET password_hash='$passwordHash' WHERE correo='$correo'");

        echo "<div class='success'>Tu nueva contraseña es: $nuevaPassword <a href='index.html'>INICIO</a></div>";
    } else {
        echo "<div class='error'>Correo no encontrado.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <div class="recovery-container">
        <h2>Recuperar Contraseña</h2>
        <form method="POST">
            <input type="email" name="correo" placeholder="Correo" required>
            <button type="submit">Recuperar Contraseña</button>
        </form>
        <a href="login.php">Volver al inicio de sesión</a>
        <a href="editar_password.php">editar contraseña</a>
    </div>
</body>
</html>
