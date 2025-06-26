<?php
// Asegúrate de definir estas constantes antes de usar la clase
define('DB_SERVER', 'mysql');
define('DB_USERNAME', 'user1');
define('DB_PASSWORD', 'passwd');
define('DB_NAME', 'restaurante');
define('DB_PORT', 3306);  // Puerto de la base de datos MySQL (por defecto 3306)
class Conexion {
    public static function conectar() {
        $host = DB_SERVER;
        $db = DB_NAME;
        $user = DB_USERNAME;
        $pass = DB_PASSWORD;
        $port = DB_PORT;  
       
        $dsn = "mysql:host=$host;port=$port;dbname=$db;charset=utf8mb4";  // Agregar el puerto a la cadena DSN

        try {
            return new PDO($dsn, $user, $pass, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]);
        } catch (PDOException $e) {
            // Puedes usar header('Content-Type: application/json'); si necesitas que la salida sea JSON puro
            die(json_encode(["error" => "Error de conexión: " . $e->getMessage()]));
        }
    }
}
?>
