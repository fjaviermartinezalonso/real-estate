<?php
    // Enviamos a la raíz si el admin no inició sesión
    require '../includes/app.php';
    use App\Propiedad;
    use App\Vendedor;

    autenticarUsuario();
    
    // Leer base de datos
    $propiedades = Propiedad::all();
    $vendedores = Vendedor::all();

    // Si se pulsó el botón de Eliminar
    if($_SERVER["REQUEST_METHOD"] === "POST") {

        $id = filter_var($_POST["id"], FILTER_VALIDATE_INT);
        if($id) {
            // El tipo a eliminar es propiedad o vendedor
            $tipo = $_POST["tipo"];
            if(validarTipo($tipo)) {
                if($tipo === "propiedad") {
                    $propiedad = Propiedad::find($id);
                    $propiedad->delete();
                }
                else if($tipo === "vendedor") {
                    $vendedor = Vendedor::find($id);
                    $vendedor->delete();
                }
            }
        }
    }

    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Admin de BienesRaices</h1>

        <h2>Propiedades</h2>
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
                            <input type="hidden" name="tipo" value="propiedad">
                            <button type="submit" class="boton-rojo-block w-100">Eliminar</a>
                        </form>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>

        <h2>Vendedores</h2>
        <table class="propiedades">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Teléfono</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($vendedores as $vendedor) {?>
                <tr>
                    <td> <?php echo $vendedor->id ?> </td>
                    <td> <?php echo $vendedor->nombre . " " . $vendedor->apellido?> </td>
                    <td> <?php echo $vendedor->telefono ?> </td>
                    <td>
                        <a href="/admin/vendedores/actualizar.php?id=<?php echo $vendedor->id?>" class="boton-amarillo-block">Actualizar</a>
                        <form method="POST">
                            <input type="hidden" name="id" value="<?php echo $vendedor->id; ?>">
                            <input type="hidden" name="tipo" value="vendedor">
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