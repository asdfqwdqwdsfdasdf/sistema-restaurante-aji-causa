<?php
require_once '../modelos/PlatoDAO.php';
require_once '../respuestas/response.php';

$dao = new PlatoDAO();

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accion = $_POST['accion'] ?? '';

    if ($accion === 'Registrar') {
        $p = new Plato(
            null,
            $_POST['nombre'],
            $_POST['descripcion'],
            $_POST['precio'],
            $_POST['imagen_url'],
            isset($_POST['disponible']) ? 1 : 0,
            $_POST['hora_disponible_desde'],
            $_POST['hora_disponible_hasta']
        );
        response($dao->insertar($p), 'Plato registrado correctamente.');

    } elseif ($accion === 'Eliminar') {
        response($dao->eliminar($_POST['id_plato']), 'Plato eliminado.');

    } else {
        response(false, 'Acción no válida.', 400);
    }
} else {
    response(false, 'Método no permitido.', 405);
}
