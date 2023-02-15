<main class="contenedor seccion">
        <h1>Contacto </h1>

        <picture>
            <source srcset="build/img/destacada3.webp" type="image/webp">
            <source srcset="build/img/destacada3.jpg" type="image/jpeg">
            <img loading="lazy" src="build/img/destacada3.jpg" alt="Imagen contacto">
        </picture>

        <h2>Llene el formulario de contacto</h2>
        
        <form class="formulario" action="/contacto" method="POST">
            <fieldset>
                <legend>Información personal</legend>
                <label for="nombre">Nombre: </label>
                <input type="text" placeholder="Tu nombre" id="nombre" name="contacto[nombre]" required>

                <label for="email">E-mail: </label>
                <input type="email" placeholder="Tu Email" id="email" name="contacto[email]" required>

                <label for="telefono">Telefono: </label>
                <input type="tel" placeholder="Tu Telefono" id="telefono" name="contacto[telefono]">

                <label for="mensaje">Mensaje: </label>
                <textarea name="contacto[mensaje]" id="mensaje"></textarea required>
            </fieldset>
            <fieldset>
                    <legend>Información sobre la propiedad</legend>
                    <label for="opciones">Vende o Compra </label>
                    <select name="contacto[tipo]" id="opciones" required>
                        <option value="" disabled selected>-- Seleccione --</option>
                        <option value="compra">Compra</option>
                        <option value="vende">Vende</option>
                    </select>

                    <label for="presupuesto">Presupuesto: </label>
                    <input name="contacto[precio]" type="number" placeholder="Tu Presupuesto" id="presupuesto" required>
            </fieldset>

            <fieldset>
                <legend>Contacto</legend>
                <p>Como desea ser Contactado</p>
                
                <div class="forma-contacto">
                    <label for="contactar-telefono">Teléfono</label>
                    <input type="radio" value="telefono" id="contactar-telefono" name="contacto[contacto]" required>

                    <label for="contactar-email">E-mail</label>
                    <input type="radio" value="email" id="contactar-email" name="contacto[contacto]" required>
                </div>

                <p>Si eligio telefono, seleccione la fecha y hora para ser contactado:</p>

                <label for="fecha">Fecha: </label>
                <input type="date" id="fecha" name="contacto[fecha]">

                <label for="hora">Hora: </label>
                <input type="time" id="hora" min="09:00" max="18:00" name="contacto[hora]">
            </fieldset>

            <input class="boton-verde" type="submit" id="">
        </form>
    </main>