    <fieldset>
        <legend>Información general</legend>

        <p>
            <label for="titulo">Título:</label>
            <input type="text" id="titulo" name="titulo" placeholder="Titulo propiedad" value="<?php echo $titulo?>">
        </p>
        <p>
            <label for="precio">Precio:</label>
            <input type="number" id="precio" name="precio" placeholder="Precio (€)" value="<?php echo $precio?>">
        </p>
        <p>
            <label for="imagen">Imagen:</label>
            <input type="file" id="imagen" name="imagen" accept="image/jpeg, image/png">
        </p>
        <p>
            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion"><?php echo $descripcion?></textarea>
        </p>
    </fieldset>
    
    <fieldset>
        <legend>Información características</legend>

        <p>
                <label for="habitaciones">Habitaciones:</label>
                <input type="number" id="habitaciones" name="habitaciones" placeholder="Ej. 3" min="1" max="9" value="<?php echo $habitaciones?>">
            </p>
        <p>
                <label for="baños">Baños:</label>
                <input type="number" id="baños" name="baños" placeholder="Ej. 3" min="1" max="9" value="<?php echo $baños?>">
            </p>
        <p>
                <label for="estacionamientos">Estacionamientos:</label>
                <input type="number" id="estacionamientos" name="estacionamientos" placeholder="Ej. 3" min="1" max="9" value="<?php echo $estacionamientos?>">
            </p>
    </fieldset>

    <fieldset>
        <legend>Vendedor</legend>
        <select name="vendedores_id" id="vendedores_id" value="<?php echo $vendedores_id?>">
            <option value="" disabled selected>-- Seleccione --</option>
            
            <?php while($row = mysqli_fetch_assoc($vendedores)) { ?>
                <option <?php echo $vendedores_id === $row["id"]? "selected" : "" ?> value="<?php echo $row["id"]; ?>"> <?php echo $row["nombre"] . " " . $row["apellido"]; ?> </option>
            <?php } ?>
            
        </select>
    </fieldset>