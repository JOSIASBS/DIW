<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h2>Inicio de sesión</h2>
    <form action="login.php" method="POST">
        <label for="email">Correo electrónico:</label><br>
        <input type="email" name="email" required><br>
        <label for="password">Contraseña:</label><br>
        <input type="password" name="password" required><br><br>
        <input type="submit" value="Iniciar sesión">
    </form>
    <br>
    <a href="register.php">Registrarse</a>

    <?php
    session_start();
    include('db.php');

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = $_POST['email'];
        $password = $_POST['password'];
        

        $sql = "SELECT * FROM usuarios WHERE Usuario_email = '$email'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            $hashed_password = md5($password);
           
    echo "Contraseña almacenada (hasheada): " . $user['Usuario_clave'] . "<br>";
           
            if ($hashed_password==$user['Usuario_clave']) {
                $_SESSION['Usuario_nombre'] = $user['Usuario_nombre'];
                header("Location: home.php");
            } else {
                echo "<p>Contraseña incorrecta</p>";
            }
        } else {
            echo "<p>El correo no existe</p>";
        }
    }

    $conn->close();
    ?>
</body>
</html>
