<?php
return [
    'Datasources' => [
        'default' => [
            'className' => 'Cake\Database\Connection',
            'driver' => 'Cake\Database\Driver\Mysql',
            'persistent' => false,
            'host' => 'localhost',
            'username' => 'root',         // Cambia si usas otro usuario
            'password' => '123456',             // Cambia si tienes contraseña
            'database' => 'minicore',  // Asegúrate de que coincida con tu BD
            'timezone' => 'UTC',
            'flags' => [],
            'cacheMetadata' => false,
        ],
    ],
];