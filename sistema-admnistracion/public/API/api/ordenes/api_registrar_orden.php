<?php
require_once '../../modelos/OrdenDAO.php';
header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

if (
    !isset($data['estado_pago']) ||
    !isset($data['metodo_pago']) ||
    !isset($data['platos']) ||
    empty($data['platos'])
) {
    echo json_encode(['success' => false, 'message' => 'Datos incompletos']);
    exit;
}

$comentario = $data['comentario'] ?? null;
$estadoPago = $data['estado_pago'];
$metodoPago = $data['metodo_pago'];
$platos = $data['platos'];

$dao = new OrdenDAO();
$success = $dao->registrarOrden($comentario, $estadoPago, $metodoPago, $platos);

echo json_encode(['success' => $success]);
