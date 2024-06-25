<?php
    require 'includes/app.php';
    incluirTemplate('header');
?>

    <main class="contenedor">
        <h1>Conócenos</h1>
        <div class="contenido-nosotros">
            <div class="imagen">
                <picture>
                    <source srcset="build/img/nosotros.webp" type="image/webp">
                    <source srcset="build/img/nosotros.jpg" type="image/jpeg">
                    <img src="build/img/nosotros.jpg" alt="Sobre nosotros" loading="lazy">
                </picture>
            </div>

            <div class="texto-nosotros">
                <blockquote>Veinticinco años de experiencia</blockquote>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Explicabo debitis possimus numquam magnam magni illo quis atque fuga! Corrupti illo amet ad fugiat? Facere aut nemo inventore obcaecati, dicta ab!</p>
                <p>Explicabo debitis possimus numquam magnam magni illo quis atque fuga! Corrupti illo amet ad fugiat? Facere aut nemo inventore obcaecati, dicta ab!</p>
            </div>
        </div>

        <section class="contenedor section">
            <h1>Más sobre nosotros</h1>
            <div class="iconos-nosotros">
                <div class="icono">
                    <img src="build/img/icono1.svg" alt="Icono seguridad" loading="lazy">
                    <h3>Seguridad</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam eos atque quaerat. Ipsam, similique incidunt placeat ut impedit veniam! Earum beatae explicabo nisi autem distinctio temporibus deserunt minima vero laborum?</p>
                </div>
                <div class="icono">
                    <img src="build/img/icono2.svg" alt="Icono precio" loading="lazy">
                    <h3>Precio</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam eos atque quaerat. Ipsam, similique incidunt placeat ut impedit veniam! Earum beatae explicabo nisi autem distinctio temporibus deserunt minima vero laborum?</p>
                </div>
                <div class="icono">
                    <img src="build/img/icono3.svg" alt="Icono tiempo" loading="lazy">
                    <h3>Tiempo</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam eos atque quaerat. Ipsam, similique incidunt placeat ut impedit veniam! Earum beatae explicabo nisi autem distinctio temporibus deserunt minima vero laborum?</p>
            </div>
        </section>
    </main>

<?php
    incluirTemplate('footer');
?>