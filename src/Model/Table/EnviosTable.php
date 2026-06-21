<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class EnviosTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);
        $this->setTable('envios');
        $this->setPrimaryKey('id_envio');

        // Relaciones obligatorias para armar los JOINs en el controlador
        $this->belongsTo('Repartidores', [
            'foreignKey' => 'id_repartidor',
        ]);
        $this->belongsTo('Zonas', [
            'foreignKey' => 'id_zona',
        ]);
    }
}
