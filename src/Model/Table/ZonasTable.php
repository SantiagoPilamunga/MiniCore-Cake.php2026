<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class ZonasTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);
        $this->setTable('zonas');
        $this->setPrimaryKey('id_zona');
    }
}
