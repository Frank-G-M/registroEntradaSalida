<?php
session_start();
include("conexion.php");

if (!isset($_SESSION['user_id'])) {
    exit();
}

$user_id = $_SESSION['user_id'];

// Verificar que no exista jornada activa
$verificar = "SELECT * FROM horario 
              WHERE ID_User = ? 
              AND Hora_Salida IS NULL";

$stmtVer = $conexion->prepare($verificar);
$stmtVer->bind_param("i", $user_id);
$stmtVer->execute();
$resVer = $stmtVer->get_result();

if ($resVer->num_rows == 0) {
    $sql = "INSERT INTO horario (ID_User, Fecha, Hora_Entrada)
            VALUES (?, CURDATE(), CURTIME())";

    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
}

echo "ok";
?>