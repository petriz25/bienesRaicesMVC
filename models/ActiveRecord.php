<?php

namespace Model;

class ActiveRecord{
    
    //Base de datos
    protected static $db;
    protected static $columnasBD=[];
    protected static $tabla = '';

    //Errores 
    protected static $errores = [];

    public static function setDB($database){
        self::$db = $database;
    }

    public function guardar(){
        if(!is_null($this->id)){
            //Actualizamos el registro
            $this->actualizar();
        }else{
            //Creamos un nuevo registro
            $this->crear();
        }
    }

    public function crear(){

    //Satinitizar datos
    $atributos = $this->sanitizarAtributos();

    //Insertar en la base de datos
    $query = " INSERT INTO " . static::$tabla . " ( ";
    $query .= join(', ', array_keys($atributos));
    $query .= " ) VALUES (' ";
    $query .= join("', '", array_values($atributos));
    $query .= " ') ";
    
    $resultado = self::$db->query($query);

    //Mensaje de exito, reedirecciona a la pestaña de crear
    if($resultado){
        echo "<script> alert('Guardado exitosamente');
        location.href = '/propiedades/crear';
        </script>";
    }else{
        echo "<script> alert('Error al guardar');
        location.href = '/propiedades/crear';
        </script>";
    }
}

    public function actualizar(){
    //Satinitizar datos
    $atributos = $this->sanitizarAtributos();

    $valores=[];
    foreach($atributos as $key=>$value){
        $valores[]="{$key} = '{$value}'";
    }

    $query = "UPDATE " . static::$tabla . " SET ";
    $query .= join(', ', $valores);
    $query .= " WHERE id= '" . self::$db->escape_string($this->id) . "' ";
    $query .= " LIMIT 1 ";

    $resultado = self::$db->query($query);
        if($resultado){
            echo "<script> alert('Actualizado exitosamente');
            location.href = '/admin';
            </script>";
        }else{
            echo "<script> alert('Error al actualizar');
            location.href = '/admin';
            </script>";
        }
    }

    //Eliminar un registro
    public function eliminar(){
        $query= "DELETE FROM " . static::$tabla . " WHERE id=" . self::$db->escape_string($this->id) . " LIMIT 1";

        $resultado = self::$db->query($query);

        if($resultado){
            $this->eliminarImagen();
            echo "<script> alert('Eliminado exitosamente');
            location.href = '/admin';
            </script>";
        }else{
            echo "<script> alert('Error al eliminar');
            location.href = '/admin';
            </script>";
        }
    }


//Identificar y unir los atributos de la BD
public function atributos(){
    $atributos = [];
    foreach(static::$columnasBD as $columna){
        if($columna === 'id')continue;
        $atributos[$columna] = $this->$columna;
    }
    return $atributos;
}

public function sanitizarAtributos(){
    $atributos = $this->atributos();
    $sanitizado =[];
    foreach($atributos as $key=>$value){
        $sanitizado[$key]=self::$db->escape_string($value);
    }
    return $sanitizado;
}

//Subida de archivos
public function setImagen($imagen){

    //Comprobar si existe una imagen 
    if(!is_null($this->id)){
        //Eliminar imagen previa
        $this->eliminarImagen();
    }

    //Asignar al atributo de imagen el nombre de la imagen
    if($imagen){
        $this->imagen = $imagen;
    }
}

//Eliminar imagen
public function eliminarImagen(){
    $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);
        if($existeArchivo){
            unlink(CARPETA_IMAGENES . $this->imagen);
        }
}

public static function getErrores(){
    return static::$errores;
}

public function validar(){
    static::$errores=[];
    return static::$errores;
}

//Listar todas los registros
    public static function all(){
    $query = "SELECT * FROM " . static::$tabla;
    
    $resultado = self::consultarSQL($query);

    return $resultado;

    }

    //Obtiene determinado numero de registros
    public static function get($cantidad){
        $query = "SELECT * FROM " . static::$tabla . " LIMIT " . $cantidad ;
        $resultado = self::consultarSQL($query);

        return $resultado;
    }

    //Busca una registro por su id
    public static function find($id){
        $query = "SELECT * FROM " . static::$tabla . " WHERE id=${id}";
        $resultado = self::consultarSQL($query);

        return array_shift($resultado);
    }


    public static function consultarSQL($query){
        //Consultamos la base de datos
        $resultado = self::$db->query($query);
        
        //Iterar los resultados 
        $array = [];

        while($registro = $resultado->fetch_assoc()){
            $array[] = static::crearObjeto($registro);
        }

        //liberar la memoria 
        $resultado->free();

        //Retornar los resultados
        return $array;
    }

    protected static function crearObjeto($registro){
        $objeto = new static;

        foreach($registro as $key => $value){
            if(property_exists( $objeto, $key )){
                $objeto->$key = $value;
            }
        }
        return $objeto;
        
    }

    //Sincroniza el objeto en memoria con los cambios realizados por el usuario
    public function sincronizar($args=[]){
        foreach($args as $key=>$value){
            if(property_exists($this, $key) && !is_null($value)){
                $this->$key=$value;
            }
        }
    }
}