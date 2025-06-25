<?php
require_once '../../conexion/Conexion.php';
header('Content-Type: application/json');

$con = Conexion::conectar();
$stmt = $con->query("SELECT id_plato, nombre, precio FROM platos WHERE disponible = 1");
echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
