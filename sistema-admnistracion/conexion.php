<?php
$host = 'localhost';
$db   = 'restaurante';      // Reemplaza con el nombre de tu base de datos
$user = 'root';           // Reemplaza con tu usuario
$pass = '';        // Reemplaza con tu contraseña
$charset = 'utf8mb4';
$dbPort = "3307";
$dsn = "mysql:host=$host;port=$dbPort;dbname=$db;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Error en la conexión a la base de datos']);
    exit;
}
?>
