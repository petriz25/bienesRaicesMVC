<main class="contenedor seccion">
        <h1>Actualizar Propiedad </h1>

        <a href="/admin" class="boton boton-verde">
            Volver al administrador
        </a>

        <?php foreach($errores as $error):  ?>
            <div class="alerta error">
                <?php echo $error;  ?>
            </div>
        <?php endforeach;  ?>
        <form method="POST" class="formulario" enctype="multipart/form-data">
            <?php
            include __DIR__ . "/formulario.php";
            ?>
            <input type="submit" value="Modificar" class="boton-amarillo">
        </form>
        
</main>