<main class="contenedor seccion">
        <h1>Administrador </h1>

        <a href="/propiedades/crear" class="boton boton-verde">
            Nueva propiedad
        </a>
        <h2>Propiedades</h2>
    </main>

    <table class="empleados">
        <thead>
            <tr>
                <th>Id</th>
                <th>Titulo</th>
                <th>Precio</th>
                <th>Imagen</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody> <!-- Mostrar los resultados  -->

        <?php foreach($propiedades as $propiedad):  ?>
            <tr>
                <td><?php echo $propiedad->id;  ?></td>
                <td><?php echo $propiedad->titulo;  ?></td>
                <td><?php echo $propiedad->precio;  ?> </td>
                <td> <img src="../imagenes/<?php echo $propiedad->imagen;  ?>" class="imagen-tabla"></td>
                <td>
                <a href="/propiedades/actualizar?id=<?php echo $propiedad->id; ?>" class="boton-azul-block boton-chico">Actualizar</a>
                    <form method="POST" class="w-100" action="/propiedades/eliminar">
                        <input type="hidden" name="id" value=<?php echo $propiedad->id;?> >
                    <input type="submit" class="boton-rojo-block boton-chico" value="Eliminar">
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    </main>