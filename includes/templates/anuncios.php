<?php 
    $db = conectarDB();

    // Leer base de datos
    $query = "SELECT * FROM propiedades LIMIT $limite";
    $propiedades = mysqli_query($db, $query);
?>

<div class="contenedor-anuncios">
    <?php while($propiedad = mysqli_fetch_assoc($propiedades)) {?>
    <div class="anuncio">
        <img src="images/<?php echo $propiedad["imagen"];?>" alt="" loading="lazy">
        <div class="contenido-anuncio">
            <h3><?php echo $propiedad["titulo"];?></h3>
            <p><?php echo $propiedad["descripcion"];?></p>
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
            <a href="/anuncio.php?id=<?php echo $propiedad["id"];?>" class="boton-amarillo-block">Ver anuncio</a>
        </div> <!-- .contenido-anuncio -->
    </div> <!-- .anuncio -->
    <?php } 
    mysqli_close($db)?>
</div>