<?php
header('Content-Type: application/json');
require_once 'config.php';

$sql = "
    SELECT 
        COUNT(o.id_orden) as totalordenes
    FROM ordenes o 
";

$result = mysqli_query($link, $sql);

if (!$result) {
    http_response_code(500);
    echo json_encode(['error' => 'Error al obtener total de órdenes']);
    exit;
}

$totalordenes = mysqli_fetch_assoc($result);  // Obtener el resultado como un arreglo asociativo

// Enviar solo el número total de órdenes
echo json_encode(['totalordenes' => (int)$totalordenes['totalordenes']]);
?>
