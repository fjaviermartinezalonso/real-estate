<?php
    // Enviamos a la raíz si el admin no inició sesión
    require '../../includes/app.php';
    use App\Propiedad;

    autenticarUsuario();

    // Validacion de identificador de propiedad
    $id = filter_var($_GET["id"], FILTER_VALIDATE_INT);
    if(!$id) {
        header("Location: /admin");
    }

    $db = conectarDB();

    // Leer base de datos
    $propiedad = Propiedad::find($id);

    $query = "SELECT id, nombre, apellido FROM vendedores";
    $vendedores = mysqli_query($db, $query);

    $errores = Propiedad::getErrores();

    // Procesado de datos enviados por el usuario
    if($_SERVER["REQUEST_METHOD"] === "POST") {

        // Asignar los atributos que han cambiado
        $args = $_POST["propiedad"];
        $propiedad->sincronizar($args);
        $propiedad->validarCampos();
        $errores = Propiedad::getErrores();

        debugVar($propiedad);
        debugVar($errores);

        if(empty($errores)) {
            // Comprobar si existe la carpeta y si no la crea
            // $imageFolder = "../../images/";
            // if(!is_dir($imageFolder)) {
            //     mkdir($imageFolder);
            // }

            // // Borrar imagen previa si la hay
            // if($imagen["name"]) {
            //     unlink($imageFolder . $imagenDB);

            //     // Gestionar subida
            //     $imageExtension = ($imagen["type"] === "image/jpeg")? ".jpg" : ".png"; // solo permitimos subir estos dos formatos
            //     $imageIdentifier = md5(uniqid(rand() , true)) . $imageExtension;
            //     move_uploaded_file($imagen["tmp_name"], $imageFolder . $imageIdentifier);
            // }
            // else {
            //     $imageIdentifier = $imagenDB; // para actualizar con la misma imagen
            // }

            // $creado = date("Y/m/d");
            
            // // Insertar en la base de datos
            // $query = "
            //     UPDATE propiedades SET titulo = '$titulo', precio = $precio, imagen = '$imageIdentifier', descripcion = '$descripcion', habitaciones = $habitaciones, baños = $baños, estacionamientos = $estacionamientos, vendedores_id = $vendedores_id WHERE id = $id";

            // $resultado = mysqli_query($db, $query);
            // $imagenDB = $imageIdentifier; // para actualizar la imagen mas abajo
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