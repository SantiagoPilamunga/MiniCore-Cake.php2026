<?php
namespace Config;

use PDO;
use PDOException;

class Database {
    public static function conectar() {
        // 1. Detectar si estamos en Clever Cloud buscando su variable de entorno nativa
        $host_clever = getenv('MYSQL_ADDON_HOST');
        
        if ($host_clever) {
            // ==========================================
            // CONFIGURACIÓN PARA PRODUCCIÓN (CLEVER CLOUD)
            // ==========================================
            $host = $host_clever;
            $port = getenv('MYSQL_ADDON_PORT');
            $user = getenv('MYSQL_ADDON_USER');
            $pass = getenv('MYSQL_ADDON_PASSWORD');
            $db   = getenv('MYSQL_ADDON_DB');
        } else {
            // ==========================================
            // CONFIGURACIÓN PARA TU COMPUTADORA (LOCAL)
            // ==========================================
            $host = '127.0.0.1';
            $port = '3306';               
            $user = 'root';               
            $pass = '123456';             // Tu contraseña local de Workbench
            $db   = 'minicore';           // Tu base de datos local
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
