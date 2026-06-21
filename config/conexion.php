<?php
namespace Config;

use PDO;
use PDOException;

class Database {
    public static function conectar() {
        // Render detectará estas variables configuradas a mano en su panel
        $host_remoto = getenv('DB_HOST');
        
        if ($host_remoto) {
            // ==========================================
            // CONFIGURACIÓN PARA PRODUCCIÓN (CLEVER CLOUD MYSQL)
            // ==========================================
            $host = $host_remoto;
            $port = getenv('DB_PORT');
            $user = getenv('DB_USER');
            $pass = getenv('DB_PASS');
            $db   = getenv('DB_NAME');
        } else {
            // ==========================================
            // CONFIGURACIÓN PARA TU COMPUTADORA (LOCAL)
            // ==========================================
            $host = '127.0.0.1';
            $port = '3306';               
            $user = 'root';               
            $pass = '123456';             // Tu clave local de Workbench
            $db   = 'minicore';           // Tu base local
        }
        
        $charset = 'utf8mb4';
        $dsn = "mysql:host=$host;port=$port;dbname=$db;charset=$charset";
        
        try {
            return new PDO($dsn, $user, $pass, [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ]);
        } catch (PDOException $e) {
            die("Error crítico de conexión a la base de datos: " . $e->getMessage());
        }
    }
}
