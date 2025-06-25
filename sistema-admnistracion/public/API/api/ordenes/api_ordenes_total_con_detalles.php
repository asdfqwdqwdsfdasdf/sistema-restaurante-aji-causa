<?php
require_once '../../modelos/OrdenDAO.php';
header('Content-Type: application/json');

$dao = new OrdenDAO();
echo json_encode($dao->obtenerOrdenesConDetalles(), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
