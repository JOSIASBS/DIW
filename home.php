<?php
session_start();

if (!isset($_SESSION['Usuario_nombre'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de inicio</title>
</head>
<body>
    <h2>Bienvenido, <?php echo $_SESSION['Usuario_nombre']; ?>!</h2>
    <p>Has iniciado sesión exitosamente.</p>
    <a href="logout.php">Cerrar sesión</a>
</body>
</html>
