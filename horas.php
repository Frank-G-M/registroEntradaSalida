<?php
session_start();
include("conexion.php");
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
$user_id = $_SESSION['user_id'];
$sqlUser = "SELECT * FROM users WHERE ID = ?";
$stmtUser = $conexion->prepare($sqlUser);
$stmtUser->bind_param("i", $user_id);
$stmtUser->execute();
$resultUser = $stmtUser->get_result();
$usuario = $resultUser->fetch_assoc();
$sqlActiva = "SELECT * FROM horario 
              WHERE ID_User = ? 
              AND Hora_Salida IS NULL
              LIMIT 1";
$stmtActiva = $conexion->prepare($sqlActiva);
$stmtActiva->bind_param("i", $user_id);
$stmtActiva->execute();
$resultActiva = $stmtActiva->get_result();
$jornadaActiva = $resultActiva->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Horas</title>
</head>
<body>
<div class="info">
    <div><p><?php echo $usuario['Name']; ?></p></div>
    <div><p><?php echo $usuario['Document']; ?></p></div>
    <div><p><?php echo $usuario['Phone']; ?></p></div>
    <div><p><?php echo $usuario['Email']; ?></p></div>
    <div><p><?php echo $usuario['Rol']; ?></p></div>
    <a href="logout.php"><button>Log out</button></a>
</div>
<div class="registro">
<?php if ($jornadaActiva): ?>
    <?php
    $fechaActiva = date("d/m/Y", strtotime($jornadaActiva['Fecha']));
    $horaActiva  = date("H:i:s", strtotime($jornadaActiva['Hora_Entrada']));
    ?>
    <div class="barra">
        <p>Fecha: <?php echo $fechaActiva; ?></p>
        <p>Hora de inicio: <?php echo $horaActiva; ?></p>
        <button onclick="cerrarJornada()">Cerrar jornada</button>
    </div>
<?php else: ?>
    <button onclick="iniciarJornada()">Iniciar jornada</button>
<?php endif; ?>
<h3>Historial</h3>
<div class="tituloH">
    <h4>Fecha</h4>
    <h4>Hora de inicio</h4>
    <h4>Hora de cierre</h4>
</div>
<ul id="historial">
<?php
$sql = "SELECT * FROM horario 
        WHERE ID_User = ?
        ORDER BY ID_Horario DESC";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
    $fecha = date("d/m/Y", strtotime($row['Fecha']));
    $horaEntrada = date("H:i:s", strtotime($row['Hora_Entrada']));

    $horaSalida = ($row['Hora_Salida'] && $row['Hora_Salida'] != "0000-00-00 00:00:00.000000")
        ? date("H:i:s", strtotime($row['Hora_Salida']))
        : "-";
    echo "<li>";
    echo "<span>{$fecha}</span>";
    echo "<span>{$horaEntrada}</span>";
    echo "<span>{$horaSalida}</span>";
    echo "</li>";
}
?>
</ul>
</div>
<script src="funcion.js?v=3"></script>
</body>
</html>