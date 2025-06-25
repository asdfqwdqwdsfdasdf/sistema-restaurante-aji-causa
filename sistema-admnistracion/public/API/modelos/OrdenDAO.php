<?php
require_once __DIR__ . '/../conexion/Conexion.php';

class OrdenDAO {
    public function obtenerOrdenesConDetalles() {
        $con = Conexion::conectar();

        // 1. Obtener todas las órdenes
        $ordenesSQL = "SELECT * FROM ordenes ORDER BY fecha_hora_creacion DESC";
        $ordenesStmt = $con->prepare($ordenesSQL);
        $ordenesStmt->execute();
        $ordenes = $ordenesStmt->fetchAll(PDO::FETCH_ASSOC);

        $resultado = [];

        foreach ($ordenes as $orden) {
            // 2. Formatear hora
            $fecha = date('h:i A', strtotime($orden['fecha_hora_creacion']));
            $dia = date('d/m', strtotime($orden['fecha_hora_creacion']));
            $hora_formateada = "$fecha | $dia";

            // 3. Obtener detalles de platos
            $detallesSQL = "
                SELECT do.cantidad, do.precio_unitario, p.nombre
                FROM detalle_orden do
                JOIN platos p ON do.id_plato = p.id_plato
                WHERE do.id_orden = ?
            ";
            $stmtDetalles = $con->prepare($detallesSQL);
            $stmtDetalles->execute([$orden['id_orden']]);
            $detalles = $stmtDetalles->fetchAll(PDO::FETCH_ASSOC);

            // 4. Construir factura y platos
            $factura = [];
            $platos = [];
            foreach ($detalles as $det) {
                $factura[] = [
                    "item" => $det['nombre'],
                    "precio" => floatval($det['precio_unitario'])
                ];

                $platos[] = [
                    "nombre" => $det['cantidad'] . "x " . $det['nombre'],
                    "estado" => "Orden aceptada" // Asumido fijo por ahora
                ];
            }

            // 5. Armar orden
            $resultado[] = [
                "id" => "#".str_pad($orden['id_orden'], 3, "0", STR_PAD_LEFT),
                "time" => $hora_formateada,
                "status" => ucfirst($orden['estado_entrega']),
                "comment" => $orden['comentarios_cliente'],
                "pago" => ucfirst($orden['estado_pago']),
                "metodo" => ucfirst($orden['metodo_pago']),
                "entrega" => ucfirst($orden['estado_entrega']),
                "factura" => $factura,
                "platos" => $platos
            ];
        }

        return $resultado;
    }
    public function obtenerTotalEntregadas() {
        $con = Conexion::conectar();
        $sql = "SELECT COUNT(*) AS total FROM ordenes WHERE estado_entrega = 'entregado'";
        $stmt = $con->query($sql);
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        return intval($resultado['total']);
    }
    public function obtenerTotalOrdenes() {
    $con = Conexion::conectar();
    $sql = "SELECT COUNT(*) AS total FROM ordenes";
    $stmt = $con->query($sql);
    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
    return intval($resultado['total']);
    }
    public function obtenerTotalPendientes() {
    $con = Conexion::conectar();
    $sql = "SELECT COUNT(*) AS total FROM ordenes WHERE estado_entrega = 'pendiente'";
    $stmt = $con->query($sql);
    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
    return intval($resultado['total']);
}
    public function cambiarEstadoOrden($id, $nuevoEstado) {
    $con = Conexion::conectar();
    $sql = "UPDATE ordenes SET estado_entrega = :estado WHERE id_orden = :id";


    $stmt = $con->prepare($sql);
    $stmt->bindParam(':estado', $nuevoEstado);
    $stmt->bindParam(':id', $id);
    return $stmt->execute();
    }

}
