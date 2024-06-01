<?php
    require '../../includes/funciones.php';
    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Crear</h1>

        <a href="/admin" class="boton boton-verde">Volver</a>

        <form action="" class="form">
            <fieldset>
                <legend>Información general</legend>

                <p>
                    <label for="titulo">Título:</label>
                    <input type="text" id="titulo" placeholder="Titulo propiedad">
                </p>
                <p>
                    <label for="precio">Precio:</label>
                    <input type="number" id="precio" placeholder="Precio (€)">
                </p>
                <p>
                    <label for="imagen">Imagen:</label>
                    <input type="file" id="imagen" accept="image/jpeg, image/png">
                </p>
                <p>
                    <label for="descripcion">Descripción:</label>
                    <textarea id="descripcion"> </textarea>
                </p>
            </fieldset>
            
            <fieldset>
                <legend>Información características</legend>
 
                <p>
                     <label for="habitaciones">Habitaciones:</label>
                     <input type="number" id="habitaciones" placeholder="Ej. 3" min="1" max="9">
                 </p>
                <p>
                     <label for="wc">Baños:</label>
                     <input type="number" id="wc" placeholder="Ej. 3" min="1" max="9">
                 </p>
                <p>
                     <label for="estacionamientos">Estacionamientos:</label>
                     <input type="number" id="estacionamientos" placeholder="Ej. 3" min="1" max="9">
                 </p>
            </fieldset>

            <fieldset>
                <legend>Vendedor</legend>
                <select name="" id="">
                    <option value="1">Julián</option>
                    <option value="2">Andrea</option>
                </select>
            </fieldset>

            <button type="submit" class="boton boton-verde">Crear propiedad</button>
        </form>
    </main>

<?php
    incluirTemplate('footer');
?>