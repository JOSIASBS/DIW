<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
</head>
<body>
    <h2>Registro de nuevo usuario</h2>
    <form action="register.php" method="POST">
        <label for="name">Nombre:</label><br>
        <input type="text" name="name" required><br>
        <label for="email">Correo electrónico:</label><br>
        <input type="email" name="email" required><br>
        <label for="password">Contraseña:</label><br>
        <input type="password" name="password" required><br>
        <label for="confirm_password">Confirmar contraseña:</label><br>
        <input type="password" name="confirm_password" required><br><br>
        <input type="submit" value="Registrarse">
    </form>
    <br>
    <a href="login.php">Volver al inicio de sesión</a>

    <?php
    include('db.php');

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        // Verificar que las contraseñas coincidan
        if ($password !== $confirm_password) {
            echo "<p>Las contraseñas no coinciden</p>";
        } else {
            // Verificar que el correo no esté registrado
            $sql = "SELECT * FROM usuarios WHERE Usuario_email = '$email'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<p>El correo ya está registrado</p>";
            } else {
                // Encriptar la contraseña
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                // Insertar nuevo usuario en la base de datos
                $sql = "INSERT INTO usuarios (Usuario_nombre, Usuario_email, Usuario_clave) VALUES ('$name', '$email', '$hashed_password')";
                
                if ($conn->query($sql) === TRUE) {
                    echo "<p>Registro exitoso. Ahora puedes iniciar sesión.</p>";
                    header("Refresh:2; url=login.php"); // Redirecciona a login.php tras 2 segundos
                } else {
                    echo "<p>Error: " . $conn->error . "</p>";
                }
            }
        }
    }

    $conn->close();
    ?>
</body>
</html>
