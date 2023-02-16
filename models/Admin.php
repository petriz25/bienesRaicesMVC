<?php

namespace Model;

class Admin extends ActiveRecord{
    //Base de datos
    protected static $tabla = 'usuarios';
    protected static $columnasBD=['id', 'email', 'password'];

    public $id;
    public $email;
    public $password;

    public function __construct($args=[])
    {
        $this->id = $args['id'] ?? null;
        $this->email = $args['email'] ?? null;
        $this->password = $args['password'] ?? null;
    }

    public function validar(){
        if(!$this->email){
            self::$errores[]="Debes de añadir tu email";
        }
        if(!$this->password){
            self::$errores[]="Debes de añadir tu contraseña";
        }
    
        return self::$errores;
    }

    public function existeUsuario(){
        //Revisar si un usario existe o no
        $query= "SELECT * FROM ". self::$tabla ." WHERE email='". $this->email ."' LIMIT 1";

        $resultado = self::$db->query($query);

        if(!$resultado->num_rows){
            self::$errores[] = "El usuario no existe";
            return;
        }else{
            return $resultado;
        }
    }

    public function comprobarPassword($resultado){
        $usuario = $resultado->fetch_object();

        $autenticado = password_verify($this->password, $usuario->password);

        if(!$autenticado){
            self::$errores[] = "Contraseña incorrecta";
            return;
        }else{
            return $resultado;
        }
    }

    public function autenticar(){
        session_start();

        //LLenar el arreglo de sesion 
        $_SESSION['usuario'] = $this->email;
        $_SESSION['login'] = true;

        header('Location: /admin');
    }
}