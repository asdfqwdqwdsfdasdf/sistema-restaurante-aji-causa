<?php
header('Content-Type: application/json');
require_once 'config.php';

$sql = "
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
";
// variable booleana que utiliza $link del config.php y $sql (la consulta sql)
$result = mysqli_query($link, $sql);

// manejo de valor false para $result
if (!$result) {
    http_response_code(500);
    echo json_encode(['error' => 'Error al obtener órdenes']);
    exit;
}

$ordenes = [];
// mysqli_fetch_assoc : recupera una fila de resultado como un array asociativo, usamos esto sobre $result (el resultado de la consulta)
// para luego iterar sobre este mediante while, definimos $fila en el parametro de while
while ($fila = mysqli_fetch_assoc($result)) {
    //Orden:
    // $id es el id de la orden obtenido en el array asociativo anteriormente mencionado
    // $id es utilizado para
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
    // FACTURA: datos para la card de factura de la orden correspondiente
    $ordenes[$id]['factura'][] = [
        'item' => $fila['nombre_plato'],
        'precio' => floatval($fila['precio_unitario']) * intval($fila['cantidad']),
    ];
    // PLATOS: utilizado para entregar una string como la siguiente: 1x Lomo Saltado
    $ordenes[$id]['platos'][] = [
        'nombre' => $fila['cantidad'] . 'x ' . $fila['nombre_plato'],
        'estado' => 'Orden aceptada'
    ];
}
// Le pasamos el array $ordenes a la funcion array_values para obtenerlos, luego mediante json_encode los codificamos a json 
echo json_encode(array_values($ordenes));
?>
