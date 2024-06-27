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
            <?php include "../../includes/templates/formulario_propiedades.php"?>

            <button type="submit" class="boton boton-verde">Crear propiedad</button>
        </form>
    </main>

<?php
    incluirTemplate('footer');
?>