<?php
    require 'includes/app.php';
    incluirTemplate('header');
?>

    <main class="contenedor contenido-centrado">
        <h1>Contacto</h1>

        <picture>
            <source srcset="build/img/destacada3.webp" type="image/webp">
            <div srcset="build/img/destacada3.jpg" type="image/jpeg"></div>
            <img src="build/img/destacada3.jpg" alt="Imagen contacto" loading="lazy">
        </picture>

        <h2>Rellene el formulario de contacto</h2>

        <form action="#" class="form">

            <fieldset>
                <legend>Información personal</legend>
                <label for="username">Nombre</label>
                <input type="text" placeholder="Nombre" id="username">
                
                <label for="useremail">Correo electrónico</label>
                <input type="email" placeholder="email@email.com" id="useremail">

                <label for="userphone">Número de teléfono</label>
                <input type="tel" placeholder="Teléfono" id="userphone">
                
                <p>Canal de comunicación preferido</p>
                <div class="radio-option">
                    <input name="radiopref" type="radio" id="radiophone" value="telefono">
                    <label for="radiophone">Teléfono</label>
                </div>
                <div class="radio-option">
                    <input name="radiopref" type="radio" id="radioemail" value="correo">
                    <label for="radioemail">Correo electrónico</label>
                </div>
                <label for="usermsg">Mensaje</label>
                <textarea id="usermsg" placeholder="Estoy interesado en la propiedad..."></textarea>
            </fieldset>

            <fieldset>
                <legend>Información sobre la propiedad</legend>
                <label for="buyoperation">Operación</label>
                <select name="" id="buyoperation">
                    <option value="" disabled selected>-- Seleccione --</option>
                    <option value="comprar">Comprar</option>
                    <option value="vender">Vender</option>
                </select>

                <label for="buyprice">Cuantía</label>
                <input type="number" placeholder="Cantidad (€)" min="0" id="buyprice">
            </fieldset>

            <div class="alinear-derecha">
                <input type="submit" class="boton-verde" value="Enviar">
            </div>
        </form>
    </main>

<?php
    incluirTemplate('footer');
?>