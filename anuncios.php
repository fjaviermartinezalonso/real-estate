<?php
    require 'includes/app.php';
    incluirTemplate('header');
?>

    <main class="contenedor">
        <h2>Casas y apartamentos en venta</h2>
        <?php 
        require 'includes/templates/anuncios.php';
        ?>
    </main>

<?php
    incluirTemplate('footer');
?>