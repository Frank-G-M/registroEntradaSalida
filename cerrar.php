<?php
session_start();
include("conexion.php");

if (!isset($_SESSION['user_id'])) {
    exit();
}

$user_id = $_SESSION['user_id'];

$sql = "UPDATE horario 
        SET Hora_Salida = CURTIME()
        WHERE ID_User = ?
        AND Hora_Salida IS NULL";

$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();

echo "ok";
?>