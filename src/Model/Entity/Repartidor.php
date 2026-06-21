<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class Repartidor extends Entity
{
    // Habilitar asignación masiva de campos de forma segura
    protected array $_accessible = [
        '*' => true,
        'id_repartidor' => false,
    ];
}
