<?php
    // Enviamos a la raíz si el admin no inició sesión
    require '../includes/app.php';
    use App\Propiedad;

    autenticarUsuario();
    
    // Leer base de datos
    $propiedades = Propiedad::all();

    // Si se pulsó el botón de Eliminar propiedad
    if($_SERVER["REQUEST_METHOD"] === "POST") {
        $id = filter_var($_POST["id"], FILTER_VALIDATE_INT);

        if($id) {
            $propiedad = Propiedad::find($id);
            $propiedad->delete();
        }
    }

    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Admin de BienesRaices</h1>

        <a href="/admin/propiedades/crear.php" class="boton boton-verde">Nueva propiedad</a>

        <table class="propiedades">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Imagen</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($propiedades as $propiedad) {?>
                <tr>
                    <td> <?php echo $propiedad->id ?> </td>
                    <td> <?php echo $propiedad->titulo ?> </td>
                    <td> <img src="/images/<?php echo $propiedad->imagen ?>" alt="imagen propiedad"></td>
                    <td> <?php echo $propiedad->precio ?>€ </td>
                    <td>
                        <a href="/admin/propiedades/actualizar.php?id=<?php echo $propiedad->id?>" class="boton-amarillo-block">Actualizar</a>
                        <form method="POST">
                            <input type="hidden" name="id" value="<?php echo $propiedad->id; ?>">
                            <button type="submit" class="boton-rojo-block w-100">Eliminar</a>
                        </form>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </main>

<?php
    incluirTemplate('footer');
?>