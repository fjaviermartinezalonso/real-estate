<?php
    require '../includes/config/database.php';
    $db = conectarDB();

    // Leer base de datos
    $query = "SELECT id, titulo, imagen, precio FROM propiedades";
    $propiedades = mysqli_query($db, $query);

    // Si se pulsó el botón de Eliminar propiedad
    if($_SERVER["REQUEST_METHOD"] === "POST") {
        $id = filter_var($_POST["id"], FILTER_VALIDATE_INT);

        if($id) {
            // Eliminar imagen asociada de la base de datos
            $query = "SELECT imagen FROM propiedades WHERE id = $id";
            $resultado = mysqli_query($db, $query);
            $imagenDB = mysqli_fetch_assoc($resultado)["imagen"];

            $imageFolder = "../images/";
            unlink($imageFolder . $imagenDB);
            
            // Eliminar registro de la tabla
            $query = "DELETE FROM propiedades WHERE id = $id";
            if(mysqli_query($db, $query)) { // si se logra recargamos página
                header("location: /admin");
            }
        }
    }

    require '../includes/funciones.php';
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
                <?php while($propiedad = mysqli_fetch_assoc($propiedades)) {?>
                <tr>
                    <td> <?php echo $propiedad["id"] ?> </td>
                    <td> <?php echo $propiedad["titulo"] ?> </td>
                    <td> <img src="/images/<?php echo $propiedad["imagen"] ?>" alt="imagen propiedad"></td>
                    <td> <?php echo $propiedad["precio"] ?>€ </td>
                    <td>
                        <a href="/admin/propiedades/actualizar.php?id=<?php echo $propiedad["id"]?>" class="boton-amarillo-block">Actualizar</a>
                        <form method="POST">
                            <input type="hidden" name="id" value="<?php echo $propiedad["id"]; ?>">
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