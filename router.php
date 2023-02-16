<?php

namespace MVC;

class Router{
    public $rutasGet=[];
    public $rutasPost=[];

    public function get($url, $fn){
        $this->rutasGet[$url] = $fn;
    }

    public function post($url, $fn){
        $this->rutasPost[$url] = $fn;
    }

    public function comprobarRutas()
    {   
        session_start();
        $auth = $_SESSION['login'] ?? null;

        //Arreglo de rutas protegidas
        $rutas_protegidas=['/admin', '/propiedades/crear','/propiedades/actualizar','/propiedades/eliminar'];
    
        $urlActual = $_SERVER['PATH_INFO'] ?? '/';
        $metodo = $_SERVER['REQUEST_METHOD'];

        if($metodo === 'GET'){
            $fn=$this->rutasGet[$urlActual] ?? null;
            //debuguear($this->rutasGet[$urlActual]);
        }else{
            $fn=$this->rutasPost[$urlActual] ?? null;
        }

        //Proteger las rutas
        if(in_array($urlActual, $rutas_protegidas) && !$auth){
                header('Location: /');
            }

        if($fn){
            //La url existe y hay una función asociada
            call_user_func($fn, $this);
        }else{
            echo "Pagina no encontrada";
        }
    }

    //Muestra una vista
    public function render($view, $datos = []){
        foreach($datos as $key=>$value){
            $$key = $value;
        }

        ob_start(); //Almacenamiento en memoria por un momento
        include __DIR__ . "/views/$view.php";
        $contenido = ob_get_clean(); //Limpia el bufer

        include __DIR__ . "/views/layout.php";
    }

}