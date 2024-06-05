<?php
    require '../includes/config/database.php';
    $db = conectarDB();

    // Leer base de datos
    $query = "SELECT id, titulo, imagen, precio FROM propiedades";
    $propiedades = mysqli_query($db, $query);



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
                    <td> <img src="/images/" <?php echo $propiedad["imagen"] ?> alt="imagen propiedad"></td>
                    <td> <?php echo $propiedad["precio"] ?>€ </td>
                    <td>
                        <a href="" class="boton-amarillo-block">Actualizar</a>
                        <a href="" class="boton-rojo-block">Eliminar</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </main>

<?php
    incluirTemplate('footer');
?>