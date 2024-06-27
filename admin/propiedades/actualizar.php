<?php
    // Enviamos a la raíz si el admin no inició sesión
    require '../../includes/app.php';
    
    autenticarUsuario();

    // Validacion de identificador de propiedad
    $id = filter_var($_GET["id"], FILTER_VALIDATE_INT);
    if(!$id) {
        header("Location: /admin");
    }

    $db = conectarDB();

    // Leer base de datos
    $query = "SELECT * FROM propiedades WHERE id = $id";
    $propiedad = mysqli_fetch_assoc(mysqli_query($db, $query));

    $query = "SELECT id, nombre, apellido FROM vendedores";
    $vendedores = mysqli_query($db, $query);

    $errores = [];
    $titulo = $propiedad["titulo"];
    $precio = $propiedad["precio"];
    $imagenDB = $propiedad["imagen"];

    $imagen = ''; // por seguridad no mostramos donde se alojan las imagenes en el server
    $descripcion = $propiedad["descripcion"];
    $habitaciones = $propiedad["habitaciones"];
    $baños = $propiedad["baños"];
    $estacionamientos = $propiedad["estacionamientos"];
    $vendedores_id = $propiedad["vendedores_id"];

    // Procesado de datos enviados por el usuario
    if($_SERVER["REQUEST_METHOD"] === "POST") {
        // Escapamos caracteres inválidos con PHP para evitar potenciales inyecciones SQL
        $titulo = mysqli_real_escape_string($db, $_POST["titulo"]);
        $precio = mysqli_real_escape_string($db, $_POST["precio"]);
        $imagen = $_FILES["imagen"];
        $descripcion = mysqli_real_escape_string($db, $_POST["descripcion"]);
        $habitaciones = mysqli_real_escape_string($db, $_POST["habitaciones"]);
        $baños = mysqli_real_escape_string($db, $_POST["baños"]);
        $estacionamientos = mysqli_real_escape_string($db, $_POST["estacionamientos"]);
        $vendedores_id = mysqli_real_escape_string($db, $_POST["vendedores_id"]);

        if(!$titulo) {
            $errores[] = "Campo Título requerido";
        }
        if(!$precio) {
            $errores[] = "Campo Precio requerido";
        }
        if($imagen["size"] > 1000000) { // limitamos 1MB tamaño maximo
            $errores[] = "El tamaño máximo de imagen es de 100Kb";
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
            // Comprobar si existe la carpeta y si no la crea
            $imageFolder = "../../images/";
            if(!is_dir($imageFolder)) {
                mkdir($imageFolder);
            }

            // Borrar imagen previa si la hay
            if($imagen["name"]) {
                unlink($imageFolder . $imagenDB);

                // Gestionar subida
                $imageExtension = ($imagen["type"] === "image/jpeg")? ".jpg" : ".png"; // solo permitimos subir estos dos formatos
                $imageIdentifier = md5(uniqid(rand() , true)) . $imageExtension;
                move_uploaded_file($imagen["tmp_name"], $imageFolder . $imageIdentifier);
            }
            else {
                $imageIdentifier = $imagenDB; // para actualizar con la misma imagen
            }

            $creado = date("Y/m/d");
            
            // Insertar en la base de datos
            $query = "
                UPDATE propiedades SET titulo = '$titulo', precio = $precio, imagen = '$imageIdentifier', descripcion = '$descripcion', habitaciones = $habitaciones, baños = $baños, estacionamientos = $estacionamientos, vendedores_id = $vendedores_id WHERE id = $id";

            $resultado = mysqli_query($db, $query);
            $imagenDB = $imageIdentifier; // para actualizar la imagen mas abajo
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