<fieldset>
                <legend>Información general</legend>

                <label for="titulo">Titulo: </label>
                <input name="propiedad[titulo]" type="text" id="titulo" placeholder="Titulo propiedad" value="<?php echo s($propiedad->titulo); ?>">

                <label for="precio">Precio: </label>
                <input name="propiedad[precio]" type="number" id="precio" placeholder="Precio propiedad" value="<?php echo s($propiedad->precio); ?>">

                <label for="imagen">Imagen: </label>
                <input type="file" id="imagen" accept="image/jpeg, image/png" name="propiedad[imagen]">
                <?php if($propiedad->imagen): ?>
                    <img src="/imagenes/<?php $propiedad->imagen ?>" class="imagen-small">
                <?php endif; ?>

                <label for="descripcion">Descripción:</label>
                <textarea name="descripcion" name="propiedad[descripcion]" id="descripcion" value="<?php echo s($propiedad->descripcion); ?>"></textarea>
            </fieldset>

            <fieldset>
                <legend>Información Propiedad</legend>

                <label for="habitaciones">Habitaciones: </label>
                <input name="propiedad[habitaciones]" type="number" id="habitaciones" placeholder="Ej: 3" min="1" max="9"  value="<?php echo s($propiedad->habitaciones); ?>">

                <label for="wc">Baños: </label>
                <input name="propiedad[wc]" type="number" id="wc" placeholder="Ej: 3" min="1" max="9"  value="<?php echo s($propiedad->wc); ?>">

                <label for="estacionamiento">Estacionamiento: </label>
                <input name="propiedad[estacionamiento]" type="number" id="estacionamiento" placeholder="Ej: 3" min="1" max="9"  value="<?php echo s($propiedad->estacionamiento); ?>">
            </fieldset>

            <fieldset>
                <legend>Vendedor</legend>
                <select name="propiedad[vendedorId]" name="" id="vendedor" value="<?php echo s($Propiedad->vendedorId); ?>">
                    <option value="">-- Seleccione --</option>
                    <?php foreach($vendedores as $vendedor):  ?>
                        <option 
                        <?php echo $propiedad->vendedorId === $vendedor->id ? 'selected' : '' ?>
                        value="<?php echo s($vendedor->id); ?>">
                        <?php echo s($vendedor->nombre) . " " . s($vendedor->apellido); ?> 
                        </option>
                    <?php endforeach; ?>
                </select>

            </fieldset>