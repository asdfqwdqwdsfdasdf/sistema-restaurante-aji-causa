<?php
require_once '../../modelos/OrdenDAO.php';

header('Content-Type: application/json');

$dao = new OrdenDAO();
$total = $dao->obtenerTotalOrdenes();

echo json_encode([
    "total" => $total
]);
