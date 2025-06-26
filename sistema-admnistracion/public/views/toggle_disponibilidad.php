<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $conexion = new mysqli("localhost", "root", "", "restaurante");
    $conexion->set_charset("utf8");

    $id_plato = $_POST['id_plato'];
    $nuevo_estado = $_POST['nuevo_estado'];

    $stmt = $conexion->prepare("UPDATE platos SET disponible = ? WHERE id_plato = ?");
    $stmt->bind_param("ii", $nuevo_estado, $id_plato);
    $stmt->execute();
    $stmt->close();
    $conexion->close();

    header("Location: admin_platos.php");
    exit;
}
?>
