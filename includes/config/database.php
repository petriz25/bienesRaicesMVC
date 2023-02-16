<?php

function conectarDB(){
    $db=new mysqli('localhost', 'root','root', 'bienesraices');

    if(!$db){
        echo("Error al conectarse");
        exit;
    }

    return $db;
}