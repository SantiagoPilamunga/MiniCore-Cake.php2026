<?php
namespace Config;

use PDO;
use PDOException;

class Database {
    public static function conectar() {
        $host = '127.0.0.1';
        $db   = 'minicore'; 
        $user = 'root';
        $pass = '123456';             
        $charset = 'utf8mb4';

        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        
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
