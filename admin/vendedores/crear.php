<?php
    // Enviamos a la raíz si el admin no inició sesión
    require '../../includes/app.php';
    use App\Vendedor;

    autenticarUsuario();

    // Leer base de datos
    $vendedor = new Vendedor();    
    $errores = Vendedor::getErrores();

    // Procesado de datos enviados por el usuario
    if($_SERVER["REQUEST_METHOD"] === "POST") {

        $vendedor = new Vendedor($_POST["vendedor"]);
        $vendedor->validarCampos();
        $errores = Vendedor::getErrores();

        if(empty($errores)) {
            $exito = $vendedor->create();
            // Limpiamos campos antes de pintar mensaje de exito en verde
            if($exito) {
                $vendedor = new Vendedor();
            }
        }
    }

    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Crear</h1>

        <?php if($exito) {?>
            <div class="alerta exito">
                <p>Vendedor creado con éxito.</p>
            </div>
        <?php } ?>

        <a href="/admin" class="boton boton-verde">Volver</a>

        <?php foreach($errores as $error): ?>
        <div class="alerta error">
            <p><?php echo $error; ?></p>
        </div>
        <?php endforeach; ?>

        <form action="/admin/vendedores/crear.php" class="form" method="POST" enctype="multipart/form-data">
            <?php include "../../includes/templates/formulario_vendedores.php"?>

            <button type="submit" class="boton boton-verde">Crear vendedor</button>
        </form>
    </main>

<?php
    incluirTemplate('footer');
?>