<?php
session_start();
include("conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $document = trim($_POST['document']);
    $password = trim($_POST['password']);

    $sql = "SELECT * FROM users WHERE Document = '$document'";
    $resultado = $conexion->query($sql);

    if ($resultado->num_rows == 1) {

        $usuario = $resultado->fetch_assoc();

        if (password_verify($password, $usuario['Password'])) {

            $_SESSION['user_id'] = $usuario['ID'];
            $_SESSION['name'] = $usuario['Name'];

            header("Location: Horas.php");
            exit();

        } else {
            echo "Contraseña incorrecta";
        }

    } else {
        echo "Usuario no encontrado";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>WELCOME</title>
</head>
<body>
  <form method="POST">
    <h2 class="titulo">LOGIN</h2>

    <div class="datos">
        <label>Documento</label>
        <input type="text" id="document" name="document" placeholder="Ingrese su documento de identidad" required>
        <label>Password</label>
        <input type="password" id="password" name="password" placeholder="Ingrese su contraseña" required>
    </div>
    <div class="interacciones">
    <a href="register.php">Sign Up</a><br><br>
    <button type="submit">Login</button>
    </div>
</form>
</body>
</html>