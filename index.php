<?php
    require 'includes/funciones.php';
    incluirTemplate('header', $inicio = true);
?>

    <main class="contenedor">
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
    </main>

    <section class="seccion contenedor">
        <h2>Casas y apartamentos en venta</h2>
        <?php 
        $limite = 3;
        require 'includes/templates/anuncios.php';
        ?>

        <div class="alinear-derecha">
            <a href="/anuncios.html" class="boton-verde">Ver todo</a>
        </div>
    </section>

    <section class="imagen-contacto">
        <h2>Encuentra la casa de tus sueños</h2>
        <p>Llena el formulario y un asesor se pondrá en contacto contigo.</p>
        <a href="/contacto.html" class="boton-amarillo">Contáctanos</a>
    </section>

    <div class="contenedor seccion seccion-inferior">
        <section class="blog">
            <h3>Nuestro blog</h3>
            <article class="entrada-blog">
                <div class="imagen">
                    <picture>
                        <source srcset="build/img/blog1.webp" type="image/webp">
                        <div srcset="build/img/blog1.jpg" type="image/jpeg"></div>
                        <img src="build/img/blog1.jpg" alt="Entrada blog 1" loading="lazy">
                    </picture>
                </div>
                <div class="texto-entrada">
                    <a href="/entrada.html">
                        <h4>Terraza en la azotea de tu casa</h4>
                        <p class="meta-info">Escrito el: <span>20/10/2023</span> por <span>Admin</span></p>
                        <p>Consejos para construir una terraza en la azotea de tu casa con los mejores materiales y ahorrando dinero.</p>
                    </a>
                </div>
            </article> <!-- .entrada-blog -->
            <article class="entrada-blog">
                <div class="imagen">
                    <picture>
                        <source srcset="build/img/blog2.webp" type="image/webp">
                        <div srcset="build/img/blog2.jpg" type="image/jpeg"></div>
                        <img src="build/img/blog2.jpg" alt="Entrada blog 2" loading="lazy">
                    </picture>
                </div>
                <div class="texto-entrada">
                    <a href="/entrada.html">
                        <h4>Guía para la decoración de tu hogar</h4>
                        <p class="meta-info">Escrito el: <span>20/10/2023</span> por <span>Admin</span></p>
                        <p>Maximiza el espacio en tu hogar con esta guía. Aprende a combinar muebles y colores para darle vida a tu casa.</p>
                    </a>
                </div>
            </article> <!-- .entrada-blog -->
        </section> <!-- .blog -->

        <section class="testimoniales">
            <h3>Testimoniales</h3>
            <div class="testimonial">
                <blockquote>El personal se comportó de forma muy profesional. Muy buena atención y la casa que me ofrecieron cumplió con todas mis expectativas.</blockquote>
                <p>-Ignacio Román Ruiz</p>
            </div>
        </section>
    </div>

<?php
    incluirTemplate('footer');
?>