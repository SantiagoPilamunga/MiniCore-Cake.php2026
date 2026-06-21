<?php
/**
 * FRONT CONTROLLER - Punto de entrada único de la aplicación MVC
 */
declare(strict_types=1);

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// Forzar la carga automática de las clases si usas Composer
if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require_once __DIR__ . '/vendor/autoload.php';
}

// Requerir manualmente el controlador para procesar la petición
require_once __DIR__ . '/src/Controller/EnviosController.php';

// Instanciar el Controlador y ejecutar la acción del Mini Core
$controlador = new \App\Controller\EnviosController();
$controlador->reporte();
