<?php
header('Content-Type: application/json');
require_once 'config.php';

try {
    $stmt = $pdo->prepare("
        SELECT 
            o.id_orden,
            o.comentarios_cliente,
            o.estado_pago,
            o.estado_entrega,
            o.metodo_pago,
            o.total,
            o.fecha_hora_creacion,
            d.id_plato,
            d.cantidad,
            d.precio_unitario,
            p.nombre AS nombre_plato
        FROM ordenes o
        LEFT JOIN detalle_orden d ON o.id_orden = d.id_orden
        LEFT JOIN platos p ON d.id_plato = p.id_plato
        ORDER BY o.id_orden DESC
    ");
    $stmt->execute();
    $result = $stmt->fetchAll();

    // Agrupar por orden
    $ordenes = [];
    foreach ($result as $fila) {
        $id = $fila['id_orden'];
        if (!isset($ordenes[$id])) {
            $ordenes[$id] = [
                'id' => '#' . str_pad($fila['id_orden'], 3, '0', STR_PAD_LEFT),
                'time' => date('h:i A | d/m', strtotime($fila['fecha_hora_creacion'])),
                'status' => ucfirst($fila['estado_entrega']),
                'comment' => $fila['comentarios_cliente'],
                'pago' => ucfirst($fila['estado_pago']),
                'metodo' => ucfirst($fila['metodo_pago']),
                'entrega' => ucfirst($fila['estado_entrega']),
                'factura' => [],
                'platos' => []
            ];
        }

        $ordenes[$id]['factura'][] = [
            'item' => $fila['nombre_plato'],
            'precio' => floatval($fila['precio_unitario']) * intval($fila['cantidad']),
        ];
        $ordenes[$id]['platos'][] = [
            'nombre' => $fila['cantidad'] . 'x ' . $fila['nombre_plato'],
            'estado' => 'Orden aceptada' // Puedes personalizar según estado real
        ];
    }

    echo json_encode(array_values($ordenes));
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Error al obtener órdenes']);
}
?>
