<?php
define('DB_SERVER', 'mysql');
define('DB_USERNAME', 'user1');
define('DB_PASSWORD', 'passwd');
define('DB_NAME', 'restaurante');
define('DB_PORT', 3306);

class Conexion {
    // Atributo estático para almacenar la instancia
    private static $instancia = null;

    // Método estático para obtener la conexión única
    public static function conectar() {
        if (self::$instancia === null) {
            $host = DB_SERVER;
            $db = DB_NAME;
            $user = DB_USERNAME;
            $pass = DB_PASSWORD;
            $port = DB_PORT;  
            
            $dsn = "mysql:host=$host;port=$port;dbname=$db;charset=utf8mb4";

            try {
                // Crear la instancia y almacenarla en la propiedad estática
                self::$instancia = new PDO($dsn, $user, $pass, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                ]);
            } catch (PDOException $e) {
                die(json_encode(["error" => "Error de conexión: " . $e->getMessage()]));
            }
        }
        
        // Retorna la instancia única
        return self::$instancia;
    }
}
?>
