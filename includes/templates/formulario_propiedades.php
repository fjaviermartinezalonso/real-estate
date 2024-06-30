    <fieldset>
        <legend>Información general</legend>

        <p>
            <label for="titulo">Título:</label>
            <input type="text" id="titulo" name="propiedad[titulo]" placeholder="Titulo propiedad" value="<?php echo htmlspecialchars($propiedad->titulo); ?>">
        </p>
        <p>
            <label for="precio">Precio:</label>
            <input type="number" id="precio" name="propiedad[precio]" placeholder="Precio (€)" value="<?php echo htmlspecialchars($propiedad->precio); ?>">
        </p>
        <p>
            <label for="imagen">Imagen:</label>
            <input type="file" id="imagen" name="propiedad[imagen]" accept="image/jpeg, image/png">

            <?php if($propiedad->imagen) { ?>
                <img src="/images/<?php echo $propiedad->imagen?>" alt="Imagen propiedad">
            <?php } ?>
        </p>
        <p>
            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="propiedad[descripcion]"><?php echo htmlspecialchars($propiedad->descripcion); ?></textarea>
        </p>
    </fieldset>
    
    <fieldset>
        <legend>Información características</legend>

        <p>
                <label for="habitaciones">Habitaciones:</label>
                <input type="number" id="habitaciones" name="propiedad[habitaciones]" placeholder="Ej. 3" min="1" max="9" value="<?php echo htmlspecialchars($propiedad->habitaciones); ?>">
            </p>
        <p>
                <label for="baños">Baños:</label>
                <input type="number" id="baños" name="propiedad[baños]" placeholder="Ej. 3" min="1" max="9" value="<?php echo htmlspecialchars($propiedad->baños); ?>">
            </p>
        <p>
                <label for="estacionamientos">Estacionamientos:</label>
                <input type="number" id="estacionamientos" name="propiedad[estacionamientos]" placeholder="Ej. 3" min="1" max="9" value="<?php echo htmlspecialchars($propiedad->estacionamientos); ?>">
            </p>
    </fieldset>

    <fieldset>
        <legend>Vendedor</legend>
        <select name="propiedad[vendedores_id]" id="vendedores_id" value="<?php echo htmlspecialchars($propiedad->vendedores_id); ?>">
            <option value="" disabled selected>-- Seleccione --</option>
            
            <?php foreach($vendedores as $vendedor) { ?>
                <option
                    <?php echo(htmlspecialchars($propiedad->vendedores_id) === $vendedor->id? "selected" : "") ?>
                    value="<?php echo htmlspecialchars($vendedor->id); ?>"> 
                    <?php echo(htmlspecialchars($vendedor->nombre) . " " . htmlspecialchars($vendedor->apellido)); ?>                     
                </option>
            <?php } ?>
            
        </select>
    </fieldset>