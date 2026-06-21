<?php
/**
 * Archivo de arranque y bootstrap de CakePHP con constantes de ruta completas
 */
declare(strict_types=1);

// Definir las constantes de ruta globales requeridas por el núcleo de CakePHP
if (!defined('DS')) {
    define('DS', DIRECTORY_SEPARATOR);
}
if (!defined('ROOT')) {
    define('ROOT', dirname(__DIR__));
}
if (!defined('APP_DIR')) {
    define('APP_DIR', 'src');
}
if (!defined('APP')) {
    define('APP', ROOT . DS . APP_DIR . DS); // <-- Esta es la constante que faltaba
}
if (!defined('CONFIG')) {
    define('CONFIG', ROOT . DS . 'config' . DS);
}
if (!defined('CACHE')) {
    define('CACHE', ROOT . DS . 'tmp' . DS . 'cache' . DS);
}

use Cake\Core\Configure;
use Cake\Core\Configure\Engine\PhpConfig;
use Cake\Datasource\ConnectionManager;

// Registrar el motor de configuración para archivos PHP
Configure::config('default', new PhpConfig());

// Cargar tu archivo de configuración config/app.php
Configure::load('app', 'default', false);

// Inicializar el gestor de conexiones con los datos de config/app.php
ConnectionManager::setConfig(Configure::consume('Datasources'));
