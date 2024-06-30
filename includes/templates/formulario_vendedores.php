    <fieldset>
        <legend>Información general</legend>

        <p>
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="vendedor[nombre]" placeholder="Nombre" value="<?php echo htmlspecialchars($vendedor->nombre); ?>">
        </p>
        <p>
            <label for="apellido">Apellido:</label>
            <input type="text" id="apellido" name="vendedor[apellido]" placeholder="Apellido" value="<?php echo htmlspecialchars($vendedor->apellido); ?>">
        </p>
        <p>
            <label for="telefono">Teléfono:</label>
            <input type="number" id="telefono" name="vendedor[telefono]" placeholder="Teléfono" value="<?php echo htmlspecialchars($vendedor->telefono); ?>">
        </p>
    </fieldset>