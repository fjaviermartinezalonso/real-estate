<?php
    // Enviamos a la raíz si el admin no inició sesión
    require '../../includes/app.php';
    use App\Vendedor;

    autenticarUsuario();

    // Validacion de identificador de vendedor
    $id = filter_var($_GET["id"], FILTER_VALIDATE_INT);
    if(!$id) {
        header("Location: /admin");
    }

    // Leer base de datos
    $vendedor = Vendedor::find($id);
    $errores = Vendedor::getErrores();

    // Procesado de datos enviados por el usuario
    if($_SERVER["REQUEST_METHOD"] === "POST") {
        // Asignar los atributos que han cambiado
        $args = $_POST["vendedor"];
        $vendedor->sincronizar($args);
        $vendedor->validarCampos();
        $errores = Vendedor::getErrores();

        if(empty($errores)) {
            // Insertar en la base de datos
            $resultado = $vendedor->create();
        }
    }

    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Actualizar</h1>

        <?php if($resultado) {?>
            <div class="alerta exito">
                <p>Vendedor actualizado con éxito.</p>
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
            <?php include "../../includes/templates/formulario_vendedores.php"?>

            <button type="submit" class="boton boton-verde">Actualizar vendedor</button>
        </form>
    </main>

<?php
    incluirTemplate('footer');
?>