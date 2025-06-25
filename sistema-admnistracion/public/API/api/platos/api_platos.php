<?php
require_once '../modelos/PlatoDAO.php';
header('Content-Type: application/json');

$dao = new PlatoDAO();
echo json_encode($dao->obtenerTodos());
