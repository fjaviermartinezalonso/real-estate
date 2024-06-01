<?php
    require '../../includes/config/database.php';
    $db = conectarDB();

    // Leer base de datos
    $query = "SELECT id, nombre, apellido FROM vendedores";
    $vendedores = mysqli_query($db, $query);

    $errores = [];
    $titulo = '';
    $precio = '';
    //$image = '';
    $descripcion = '';
    $habitaciones = '';
    $baños = '';
    $estacionamientos = '';
    $vendedores_id = '';

    // Procesado de datos enviados por el usuario
    if($_SERVER["REQUEST_METHOD"] === "POST") {
        $titulo = $_POST["titulo"];
        $precio = $_POST["precio"];
        //$imagen = $_POST["imagen"];
        $descripcion = $_POST["descripcion"];
        $habitaciones = $_POST["habitaciones"];
        $baños = $_POST["baños"];
        $estacionamientos = $_POST["estacionamientos"];
        $vendedores_id = $_POST["vendedores_id"];

        if(!$titulo) {
            $errores[] = "Campo Título requerido";
        }
        if(!$precio) {
            $errores[] = "Campo Precio requerido";
        }
        if(!$descripcion) {
            $errores[] = "Campo Descripción requerido";
        }
        if(strlen($descripcion) < 50) {
            $errores[] = "La descripción requiere al menos 50 caracteres";
        }
        if(!$habitaciones) {
            $errores[] = "Campo Habitaciones requerido";
        }
        if(($habitaciones < 0) || ($habitaciones > 9)) {
            $errores[] = "El rango válido de Habitaciones es de 1 a 9";
        }
        if(!$baños) {
            $errores[] = "Campo Baños requerido";
        }
        if(($baños < 0) || ($baños > 9)) {
            $errores[] = "El rango válido de Baños es de 1 a 9";
        }
        if(!$estacionamientos) {
            $errores[] = "Campo Estacionamientos requerido";
        }
        if(($estacionamientos < 0) || ($estacionamientos > 9)) {
            $errores[] = "El rango válido de Estacionamientos es de 1 a 9";
        }
        if(!$vendedores_id) {
            $errores[] = "Campo Vendedor requerido";
        }

        if(empty($errores)) {
            $creado = date("Y/m/d");

            // Insertar en la base de datos
            $query = "
                INSERT INTO propiedades (titulo, precio, descripcion, habitaciones, baños, estacionamientos, creado, vendedores_id) 
                VALUES ( '$titulo', '$precio', '$descripcion', '$habitaciones', '$baños', '$estacionamientos', '$creado', '$vendedores_id' )";

            $resultado = mysqli_query($db, $query);
            if($resultado) {
                // Redireccionamos al usuario
                //header("Location: /admin");

                // Limpiamos campos antes de pintar mensaje de exito en verde
                $titulo = '';
                $precio = '';
                //$image = '';
                $descripcion = '';
                $habitaciones = '';
                $baños = '';
                $estacionamientos = '';
                $vendedores_id = '';
            }
        }
    }

    require '../../includes/funciones.php';
    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Crear</h1>

        <?php if($resultado) {?>
            <div class="alerta exito">
                <p>Propiedad creada con éxito.</p>
            </div>
        <?php } ?>

        <a href="/admin" class="boton boton-verde">Volver</a>

        <?php foreach($errores as $error): ?>
        <div class="alerta error">
            <p><?php echo $error; ?></p>
        </div>
        <?php endforeach; ?>

        <form action="/admin/propiedades/crear.php" class="form" method="POST">
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
                    <textarea id="descripcion" name="descripcion"> <?php echo $descripcion?> </textarea>
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

            <button type="submit" class="boton boton-verde">Crear propiedad</button>
        </form>
    </main>

<?php
    incluirTemplate('footer');
?>