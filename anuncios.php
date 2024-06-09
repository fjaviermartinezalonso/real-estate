<?php
    require 'includes/funciones.php';
    incluirTemplate('header');
?>

    <main class="contenedor">
        <h2>Casas y apartamentos en venta</h2>
        <?php 
        $limite = 10;
        require 'includes/templates/anuncios.php';
        ?>
    </main>

<?php
    incluirTemplate('footer');
?>