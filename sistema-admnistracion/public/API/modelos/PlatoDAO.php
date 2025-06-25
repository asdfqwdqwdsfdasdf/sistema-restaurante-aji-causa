<?php
require_once __DIR__ . '/../conexion/Conexion.php';
require_once __DIR__ . '/Plato.php';

class PlatoDAO {
    public function insertar($p) {
        $sql = "INSERT INTO platos (nombre, descripcion, precio, imagen_url, disponible, hora_disponible_desde, hora_disponible_hasta)
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $con = Conexion::conectar();
        $stmt = $con->prepare($sql);
        return $stmt->execute([
            $p->nombre, $p->descripcion, $p->precio,
            $p->imagen_url, $p->disponible, $p->hora_desde, $p->hora_hasta
        ]);
    }

    public function obtenerTodos() {
        $sql = "SELECT * FROM platos";
        $con = Conexion::conectar();
        $stmt = $con->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function eliminar($id) {
        $sql = "DELETE FROM platos WHERE id_plato = ?";
        $con = Conexion::conectar();
        $stmt = $con->prepare($sql);
        return $stmt->execute([$id]);
    }

    // Puedes agregar update, getById, etc.
}
?>
