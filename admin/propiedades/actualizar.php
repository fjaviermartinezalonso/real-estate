<?php
    // Enviamos a la raíz si el admin no inició sesión
    require '../../includes/app.php';
    use App\Propiedad;
    use Intervention\Image\ImageManager;
    use Intervention\Image\Drivers\Imagick\Driver;

    autenticarUsuario();

    // Validacion de identificador de propiedad
    $id = filter_var($_GET["id"], FILTER_VALIDATE_INT);
    if(!$id) {
        header("Location: /admin");
    }

    // Leer base de datos
    $propiedad = Propiedad::find($id);
    $errores = Propiedad::getErrores();
    
    $db = conectarDB();
    $query = "SELECT id, nombre, apellido FROM vendedores";
    $vendedores = mysqli_query($db, $query);

    // Procesado de datos enviados por el usuario
    if($_SERVER["REQUEST_METHOD"] === "POST") {
        // Asignar los atributos que han cambiado
        $args = $_POST["propiedad"];
        $propiedad->sincronizar($args);

        // Crear identificador unico para la imagen
        $imagen = $_FILES["propiedad"]["tmp_name"]["imagen"];
        $imageExtension = ($_FILES["propiedad"]["type"]["imagen"] === "image/jpeg")? ".jpg" : ".png"; // solo permitimos subir estos dos formatos
        $imageIdentifier = md5(uniqid(rand() , true)) . $imageExtension;
        $imagenDB = $imageIdentifier; // para actualizar la imagen mas abajo
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
            $image = $manager->read($_FILES["propiedad"]["tmp_name"]["imagen"])->resize(800,600)->save(IMAGENES_URL . $imageIdentifier);

            // Insertar en la base de datos
            $resultado = $propiedad->create();
        }
    }

    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Actualizar</h1>

        <?php if($resultado) {?>
            <div class="alerta exito">
                <p>Propiedad actualizada con éxito.</p>
            </div>
        <?php } ?>

        <a href="/admin" class="boton boton-verde">Volver</a>

        <?php foreach($errores as $error): ?>
        <div class="alerta error">
            <p><?php echo $error; ?></p>
        </div>
        <?php endforeach; ?>

        <!-- form sin atributo action envia gestiona el resultado en esta misma URL -->
        <form class="form" method="POST" enctype="multipart/form-data">
            <?php include "../../includes/templates/formulario_propiedades.php"?>

            <button type="submit" class="boton boton-verde">Actualizar propiedad</button>
        </form>
    </main>

<?php
    incluirTemplate('footer');
?>