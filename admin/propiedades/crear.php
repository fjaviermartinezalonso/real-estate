<?php
    // Enviamos a la raíz si el admin no inició sesión
    require '../../includes/app.php';
    use App\Propiedad;
    use Intervention\Image\ImageManager;
    use Intervention\Image\Drivers\Imagick\Driver;

    autenticarUsuario();
    $db = conectarDB();

    // Leer base de datos
    $query = "SELECT id, nombre, apellido FROM vendedores";
    $vendedores = mysqli_query($db, $query);

    $errores = Propiedad::getErrores();
    $titulo = '';
    $precio = '';
    $image = '';
    $descripcion = '';
    $habitaciones = '';
    $baños = '';
    $estacionamientos = '';
    $vendedores_id = '';

    // Procesado de datos enviados por el usuario
    if($_SERVER["REQUEST_METHOD"] === "POST") {

        $propiedad = new Propiedad($_POST);

        // Crear identificador unico para la imagen
        $imagen = $_FILES["imagen"];
        $imageExtension = ($imagen["type"] === "image/jpeg")? ".jpg" : ".png"; // solo permitimos subir estos dos formatos
        $imageIdentifier = md5(uniqid(rand() , true)) . $imageExtension;
        $propiedad->setImage($imageIdentifier);

        $propiedad->validarCampos();
        $errores = Propiedad::getErrores();

        if(empty($errores)) {
            // Comprobar si existe la carpeta y si no la crea
            if(!is_dir(IMAGENES_URL)) {
                mkdir(IMAGENES_URL);
            }
            // Resize a la imagen con Intervention y subida al servidor
            $manager = new ImageManager(new Driver());
            $image = $manager->read($_FILES["imagen"]["tmp_name"])->resize(800,600)->save(IMAGENES_URL . $imageIdentifier);

            $resultado = $propiedad->create();
            if($resultado) {
                // Redireccionamos al usuario
                //header("Location: /admin");
                /*Opcionalmente podría pasarle como parámetro un mensaje a mostrar, por ejemplo:
                "Location: /admin&mensaje=Propiedad creada con éxito". Luego tendría que leer
                dicho parámetro con GET: $mensaje = $_GET["mensaje"] ?? null;
                En caso de que al acceder a la URL no haya GET (por ejemplo al acceder por primera
                vez), "?? null" inicializa a null la variable $mensaje */

                // Limpiamos campos antes de pintar mensaje de exito en verde
                $titulo = '';
                $precio = '';
                $image = '';
                $descripcion = '';
                $habitaciones = '';
                $baños = '';
                $estacionamientos = '';
                $vendedores_id = '';
            }
        }
    }

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

        <form action="/admin/propiedades/crear.php" class="form" method="POST" enctype="multipart/form-data">
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

            <button type="submit" class="boton boton-verde">Crear propiedad</button>
        </form>
    </main>

<?php
    incluirTemplate('footer');
?>