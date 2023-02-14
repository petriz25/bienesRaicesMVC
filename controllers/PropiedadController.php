<?php 

namespace Controllers;
use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;

class PropiedadController{
    public static function index(Router $router){
        $propiedades = Propiedad::all();

        $router->render('propiedades/admin', [
            'propiedades' => $propiedades
        ]);
    }

    public static function crear(Router $router){
        $propiedad = new Propiedad();
        $vendedores = Vendedor::all();
        //Arreglo con mensaje de errores
        $errores= Propiedad::getErrores();

        if($_SERVER['REQUEST_METHOD']=== 'POST'){

            $propiedad = new Propiedad($_POST['propiedad']);
        
            //CREANDO NOMBRE UNICO PARA CADA IMAGEN
            $nombreImagen= md5(uniqid( rand(), true) ) . ".jpg";
        
            //Realia un resize a la imagen usando intervention
            if($_FILES['propiedad']['tmp_name']['imagen']){
                $image=Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
                $propiedad->setImagen($nombreImagen);
            }
        
            $errores=$propiedad->validar();
        
            //Revisar que el arreglo de errores este vacio
            if(empty($errores)){
                //CREAR UNA CARPETA PARA IMAGENES
                if(!is_dir(CARPETA_IMAGENES)) { mkdir(CARPETA_IMAGENES);}
        
                //Guardar la imagen en el servidor
                $image->save(CARPETA_IMAGENES . $nombreImagen);
        
                //Guardar en la base de datos
                $propiedad->guardar();
        }
            }

        $router->render('propiedades/crear', [
            'propiedad' => $propiedad, 
            'vendedores' => $vendedores,
            'errores' => $errores
        ]);
    }

    public static function actualizar(Router $router){
        $id = reedireccionar('/admin');
        $vendedores = Vendedor::all();
        $propiedad = Propiedad::find($id);
        //Arreglo con mensaje de errores
        $errores= Propiedad::getErrores();

        $router->render('propiedades/actualizar', [
            'propiedad' => $propiedad, 
            'errores' => $errores,
            'vendedores' => $vendedores
        ]);
    }
    }