<?php
include("conexion.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $document = trim($_POST['document']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $password = trim($_POST['password']);
    $rol = $_POST['rol'];
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO users (Name, Document, Email, Phone, Password, Rol)
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ssssss", $name, $document, $email, $phone, $hashedPassword, $rol);
    if ($stmt->execute()) {
        echo "Usuario registrado correctamente";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Registro</title>
</head>
<body>
    <form id="formRegistro" method="POST">
    <h2 class="titulo">SIGN UP</h2>

    <div class="datos">
        <label>Nombre</label>
        <input type="text" id="name" name="name" required>

        <label>Telefono</label>
        <input type="number" id="phone" name="phone" required>

        <label>Documento</label>
        <input type="number" id="document" name="document" required>

        <label>Correo</label>
        <input type="email" id="email" name="email" required>

        <label>Contraseña</label>
        <input type="password" id="password" name="password" required>

        <label>Rol</label>
<select name="rol" required>
    <option value="">Seleccione un rol</option>
    <option value="Medico">Médico</option>
    <option value="Enfermero">Enfermero</option>
    <option value="Administrativo">Administrativo</option>
</select>
    </div>
    <div class="interacciones">
        <a href="index.php">Login</a><br><br>
        <button type="submit">Sign Up</button>
    </div>
</form>
</body>
</html>
