<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class RepartidoresTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);
        $this->setTable('repartidores');
        $this->setPrimaryKey('id_repartidor');

        // Un repartidor tiene asociados muchos envíos
        $this->hasMany('Envios', [
            'foreignKey' => 'id_repartidor',
        ]);
    }
}
