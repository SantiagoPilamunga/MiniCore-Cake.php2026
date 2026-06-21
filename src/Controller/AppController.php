<?php
namespace App\Controller;

use Cake\Controller\Controller;

class AppController extends Controller
{
    public function initialize(): void
    {
        parent::initialize();
        // Carga componentes globales si los necesitas (ej: Flash)
        $this->loadComponent('Flash');
    }
}
