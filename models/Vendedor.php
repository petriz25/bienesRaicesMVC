<?php 

namespace Model;

class Vendedor extends ActiveRecord{
    protected static $tabla = 'vendedores';
    protected static $columnasBD=['id', 'nombre', 'apellido', 'telefono'];

    public $id='';
    public $nombre='';
    public $apellido='';
    public $telefono='';

    public function __construct($args = []){
        $this->id = $args['id'] ?? NULL;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->telefono = $args['telefono'] ?? NULL;
    }
}