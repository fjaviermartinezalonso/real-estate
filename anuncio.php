<?php
    $id = $_GET["id"];

    // En caso de que no haya id que buscar en la BD (error) volvemos a la raíz
    if(!$id) {
        header("location: /");
    }

    require './includes/config/database.php';
    $db = conectarDB();

    // Leer base de datos
    $query = "SELECT * FROM propiedades WHERE id = $id";
    $res = mysqli_query($db, $query);

    // Si el id no existe en la base de datos volvemos a la raíz
    if(!$res->num_rows) {
        header("location: /");
    }    
    $propiedad = mysqli_fetch_assoc($res);

    require 'includes/funciones.php';
    incluirTemplate('header');
?>

    <main class="contenedor contenido-centrado">
        <h2><?php echo $propiedad["titulo"];?></h2>
        <img src="/images/<?php echo $propiedad["imagen"];?>" alt="Foto de la propiedad" loading="lazy">

        <div class="resumen-propiedad">
            <p class="precio"><?php echo $propiedad["precio"];?>€</p>
            <ul class="iconos-caracteristicas">
                <li>
                    <img src="build/img/icono_wc.svg" alt="Icono WC" loading="lazy">
                    <p><?php echo $propiedad["baños"];?></p>
                </li>
                <li>
                    <img src="build/img/icono_estacionamiento.svg" alt="Icono estacionamiento" loading="lazy">
                    <p><?php echo $propiedad["estacionamientos"];?></p>
                </li>
                <li>
                    <img src="build/img/icono_dormitorio.svg" alt="Icono dormitorio" loading="lazy">
                    <p><?php echo $propiedad["habitaciones"];?></p>
                </li>
            </ul> <!-- .iconos-caracteristicas -->

            <p><?php echo $propiedad["descripcion"];?></p>
        </div>

    </main>

<?php
    incluirTemplate('footer');
    mysqli_close($db);
?>