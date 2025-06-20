<?php
header('Content-Type: application/json');
require_once 'config.php';
$sql = "
    SELECT 
        COUNT(*) as totalordenesentregadas
    FROM ordenes o 
    WHERE o.estado_entrega = 'entregado'
";


$result = mysqli_query($link, $sql);

if (!$result) {
    http_response_code(500);
    echo json_encode(['error' => 'Error al obtener total de órdenes']);
    exit;
}

$totalordenesentregadas = mysqli_fetch_assoc($result);  // Obtener el resultado como un arreglo asociativo

// Enviar solo el número total de órdenes 
// {"totalordenesentregadas":x}
echo json_encode(['totalordenesentregadas' => (int)$totalordenesentregadas['totalordenesentregadas']]);
?>
