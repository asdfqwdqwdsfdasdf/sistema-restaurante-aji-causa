<?php
require_once '../../modelos/OrdenDAO.php';

header('Content-Type: application/json');

$input = json_decode(file_get_contents('php://input'), true);

if (!isset($input['id']) || !isset($input['estado'])) {
    echo json_encode(['success' => false, 'message' => 'Datos incompletos']);
    exit;
}

$id = $input['id'];
$estado = $input['estado'];

$dao = new OrdenDAO();
$resultado = $dao->cambiarEstadoOrden($id, $estado);

echo json_encode(['success' => $resultado]);
