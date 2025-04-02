<?php
include("conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = mysqli_real_escape_string($conex, $_POST['correo']);
    $nuevaPassword = mysqli_real_escape_string($conex, $_POST['nuevaPassword']);

    // Verificar si el usuario existe
    $query = "SELECT * FROM empleados WHERE correo='$correo'";
    $result = mysqli_query($conex, $query);

    if (mysqli_num_rows($result) > 0) {
        // Hash de la nueva contraseña
        $passwordHash = password_hash($nuevaPassword, PASSWORD_BCRYPT);

        // Actualizar la contraseña en la base de datos
        mysqli_query($conex, "UPDATE empleados SET password_hash='$passwordHash' WHERE correo='$correo'");

        echo "<div class='success'>La contraseña se actualizó correctamente. <a href='login.php'>Iniciar sesión</a></div>";
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
    <title>Editar Contraseña</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <div class="edit-password-container">
        <h2>RECUPERAR CONTRASEÑA</h2>
        <form method="POST">
            <input type="email" name="correo" placeholder="Correo" required>
            <input type="password" name="nuevaPassword" placeholder="Nueva Contraseña" required>
            <button type="submit">Actualizar Contraseña</button>
        </form>
        <a href="login.php">Volver al inicio de sesión</a>
    </div>
</body>
</html>
