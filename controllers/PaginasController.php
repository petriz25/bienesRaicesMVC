<?php

namespace Controllers;
use MVC\router;
use Model\Propiedad;
use PHPMailer\PHPMailer\PHPMailer;

class PaginasController{
    public static function index(Router $router){
        $propiedades = Propiedad::get(3);
        $inicio = true;

        $router->render('paginas/index', [
            'propiedades' => $propiedades, 
            'inicio' => $inicio
        ]);
    }
    public static function nosotros(Router $router){
        $router->render('paginas/nosotros', []);
    }
    public static function propiedades(Router $router){
        $propiedades = Propiedad::all();
        
        $router->render('paginas/propiedades', [
            'propiedades' => $propiedades   
        ]);
    }
    public static function propiedad(Router $router){
        $id = reedireccionar('/propiedades');
        $propiedad = Propiedad::find($id);

        $router->render('paginas/propiedad', [
            'propiedad' => $propiedad
        ]);
    }
    public static function blog(Router $router){
        $router->render('paginas/blog', [
            
        ]);
    }
    public static function entrada(Router $router){
        $router->render('paginas/entrada', [
            
        ]);
    }
    public static function contacto(Router $router){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $respuestas = $_POST['contacto'];

            //Crear una nueva instancia de PHPMailer
            $mail = new PHPMailer();

            //Configurar SMTP
            $mail->isSMTP();
            $mail->Host = 'sandbox.smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Username = '2233e2af5ccd2d';
            $mail->Password = '6087cb472267b2';
            $mail->SMTPSecure = 'tls'; //Transport Layer Security
            $mail->Port = 2525;

            //Configurar el contenido del e-mail
            $mail->setFrom('admin@bienesraices.com');
            $mail->addAddress('admin@bienesraices.com', 'BienesRaices.com');
            $mail->Subject = ('Tienes un nuevo mensaje');

            //Habilitar HTML
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';

            //Definir contenido 
            $contenido =  '<html>';
            $contenido .= '<p>Tienes un nuevo mensaje: </p>'; 
            $contenido .= '<p>Nombre: ' . $respuestas['nombre'] . ' </p>';
            $contenido .= '<p>Email: ' . $respuestas['email'] . ' </p>';
            $contenido .= '<p>Teléfono: ' . $respuestas['telefono'] . ' </p>';
            $contenido .= '<p>Mensaje: ' . $respuestas['mensaje'] . ' </p>';
            $contenido .= '<p>Vende o compra: ' . $respuestas['tipo'] . ' </p>';
            $contenido .= '<p>Precio o Presupuesto: $' . $respuestas['precio'] . ' </p>';
            $contenido .= '<p>Prefiere ser contactado por: ' . $respuestas['contacto'] . ' </p>';
            $contenido .= '<p>Fecha de contacto: ' . $respuestas['fecha'] . ' </p>';
            $contenido .= '<p>Hora: ' . $respuestas['hora'] . ' </p>';
            $contenido .= '</html>';

            $mail->Body = $contenido;
            $mail->AltBody = 'Esto es texto alternativo';

            //Enviar email
            if($mail->send()){
                echo 'Mensaje enviado correctamente';
            }else{
                echo 'El mensaaje no se pudo enviar';
            }
        }
        $router->render('paginas/contacto', [
            
        ]);
    }
}