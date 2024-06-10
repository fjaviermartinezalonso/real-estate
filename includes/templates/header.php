<?php 
    if(!isset($_SESSION)) {
        session_start();
    }
    $auth = $_SESSION["login"] ?? null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienes raíces</title>
    <link rel="stylesheet" href="/build/css/app.css">
</head>
<body>
    
    <header class="header <?php echo $inicio? 'inicio' : '' ?>">
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="/index.php">
                    <img src="/build/img/logo.svg" alt="Logotipo de la empresa">
                </a>
                <nav class="navegacion">
                    <a href="/nosotros.php">Nosotros</a>
                    <a href="/anuncios.php">Anuncios</a>
                    <a href="/blog.php">Blog</a>
                    <a href="/contacto.php">Contacto</a>
                    <?php if($auth) { ?>
                    <a href="/cerrarSesion.php">Cerrar sesión</a>
                    <?php } ?>
                </nav>
            </div>
            <?php if($inicio) { ?>
                <h1>Venta de casas y apartamentos exclusivos de lujo</h1>
            <?php } ?>
        </div>
    </header>