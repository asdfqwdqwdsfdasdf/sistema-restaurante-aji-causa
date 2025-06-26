<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $conexion = new mysqli("localhost", "root", "", "restaurante");
    $conexion->set_charset("utf8");

    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    $id_plato = $_POST['id_plato'];
    $precio = $_POST['precio'];
    $hora_desde = $_POST['hora_desde'];
    $hora_hasta = $_POST['hora_hasta'];

    $stmt = $conexion->prepare("UPDATE platos SET precio = ?, hora_disponible_desde = ?, hora_disponible_hasta = ? WHERE id_plato = ?");
    $stmt->bind_param("dssi", $precio, $hora_desde, $hora_hasta, $id_plato);
    $stmt->execute();
    $stmt->close();
    $conexion->close();

    header("Location: admin_platos.php");
    exit;
}
?>
