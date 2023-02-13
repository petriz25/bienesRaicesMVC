<?php

namespace Model;

class Propiedad extends ActiveRecord{
    protected static $tabla = 'propiedad';
    protected static $columnasBD=['id','titulo','precio','imagen','descripcion','habitaciones','wc','estacionamiento','vendedorId'];

    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamiento;
    public $vendedorId;

    public function __construct($args = []){
        $this->id = $args['id'] ?? NULL;
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? NULL;
        $this->descripcion = $args['descripcion'] ?? '';
        $this->habitaciones = $args['habitaciones'] ?? '';
        $this->wc = $args['wc'] ?? '';
        $this->estacionamiento = $args['estacionamiento'] ?? '';
        $this->vendedorId = $args['vendedorId'] ?? '';
    }

    public function validar(){
        if(!$this->titulo){
            self::$errores[]="Debes de añadir el titulo";
        }
        if(!$this->precio){
            self::$errores[]="Debes de añadir el precio";
        }
        if(!$this->habitaciones){
            self::$errores[]="Debes de añadir el numero de habitaciones";
        }
        if(!$this->wc){
            self::$errores[]="Debes de añadir el numero de baños";
        }
        if(!$this->estacionamiento){
            self::$errores[]="Debes de añadir el numero de estacionamientos";
        }
        if(!$this->vendedorId){
            self::$errores[]="Debes seleccionar el vendedor";
        }
        if(!$this->imagen){
        self::$errores[]= "Debes agregar una imagen";
        }
    
        return self::$errores;
    }
}