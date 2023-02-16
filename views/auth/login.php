<main class="contenedor seccion contenido-centrado">
        <h1>Iniciar Sesión </h1>

        <?php foreach($errores as $error):  ?>
        <div class="alerta error">
        <?php echo $error;  ?>
        </div>
        <?php endforeach;  ?>

        <form method="POST" action="/login" class="formulario">
        <fieldset>
                <legend>Email y Password</legend>
                <label for="email">E-mail: </label>
                <input type="email" placeholder="Tu Email" name="email" id="email" require>

                <label for="password">Contraseña: </label>
                <input type="password" placeholder="Tu Contraseña" name="password" id="password" require>
            </fieldset>

            <input type="submit" value="Iniciar Sesión" class="boton boton-verde">

        </form>
    </main>