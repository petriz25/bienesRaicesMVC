<?php

namespace MVC;

class Router{
    public $rutasGet=[];
    public $rutasPost=[];

    public function get($url, $fn){
        $this->rutasGet[$url] = $fn;
    }

    public function comprobarRutas()
    {
        $urlActual = $_SERVER['REQUEST_URI'] ?? '/';
        $metodo = $_SERVER['REQUEST_METHOD'];

        debuguear($_SERVER);

        if($metodo === 'GET'){
            $fn=$this->rutasGet[$urlActual] ?? null;
        }

        if($fn){
            //La url existe y hay una función asociada
            call_user_func($fn, $this);
        }else{
            echo "Pagina no encontrada";
        }
    }

    //Muestra una vista
    public function render($view){

        ob_start();
        include __DIR__ . "views/$view";
        $contenido = ob_get_clean();

        include __DIR__ . "views/layout.php";
    }

}