<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Conexión a la base de datos
    $conexion = new mysqli("mysql", "user1", "passwd", "restaurante");
    $conexion->set_charset("utf8");

    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    // Recoger los datos del formulario
    $id_plato = $_POST['id_plato'];
    $precio = $_POST['precio'];
    $hora_desde = $_POST['hora_desde'];
    $hora_hasta = $_POST['hora_hasta'];
    $imagen_url = isset($_POST['imagen_url']) ? $_POST['imagen_url'] : null; // Recoger la URL de la imagen

    // Preparar la consulta de actualización
    if ($imagen_url) {
        $stmt = $conexion->prepare("UPDATE platos SET precio = ?, hora_disponible_desde = ?, hora_disponible_hasta = ?, imagen_url = ? WHERE id_plato = ?");
        $stmt->bind_param("dsssi", $precio, $hora_desde, $hora_hasta, $imagen_url, $id_plato);
    } else {
        // Si no se proporciona una nueva URL de la imagen, no se actualiza
        $stmt = $conexion->prepare("UPDATE platos SET precio = ?, hora_disponible_desde = ?, hora_disponible_hasta = ? WHERE id_plato = ?");
        $stmt->bind_param("dssi", $precio, $hora_desde, $hora_hasta, $id_plato);
    }

    // Ejecutar la consulta
    $stmt->execute();
    $stmt->close();
    $conexion->close();

    // Redirigir después de la actualización
    header("Location: admin_platos.php");
    exit;
}
?>
