<?php
    require 'includes/funciones.php';
    incluirTemplate('header');
?>

    <main class="contenedor contenido-centrado">
        <h1>Nuestro blog</h1>

        <section class="blog">
            <article class="entrada-blog">
                <div class="imagen">
                    <picture>
                        <source srcset="build/img/blog1.webp" type="image/webp">
                        <div srcset="build/img/blog1.jpg" type="image/jpeg"></div>
                        <img src="build/img/blog1.jpg" alt="Entrada blog 1" loading="lazy">
                    </picture>
                </div>
                <div class="texto-entrada">
                    <a href="entrada.html">
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
                    <a href="entrada.html">
                        <h4>Guía para la decoración de tu hogar</h4>
                        <p class="meta-info">Escrito el: <span>20/10/2023</span> por <span>Admin</span></p>
                        <p>Maximiza el espacio en tu hogar con esta guía. Aprende a combinar muebles y colores para darle vida a tu casa.</p>
                    </a>
                </div>
            </article> <!-- .entrada-blog -->
            <article class="entrada-blog">
                <div class="imagen">
                    <picture>
                        <source srcset="build/img/blog3.webp" type="image/webp">
                        <div srcset="build/img/blog3.jpg" type="image/jpeg"></div>
                        <img src="build/img/blog3.jpg" alt="Entrada blog 3" loading="lazy">
                    </picture>
                </div>
                <div class="texto-entrada">
                    <a href="entrada.html">
                        <h4>Guía para la decoración de tu hogar</h4>
                        <p class="meta-info">Escrito el: <span>20/10/2023</span> por <span>Admin</span></p>
                        <p>Maximiza el espacio en tu hogar con esta guía. Aprende a combinar muebles y colores para darle vida a tu casa.</p>
                    </a>
                </div>
            </article> <!-- .entrada-blog -->
            <article class="entrada-blog">
                <div class="imagen">
                    <picture>
                        <source srcset="build/img/blog4.webp" type="image/webp">
                        <div srcset="build/img/blog4.jpg" type="image/jpeg"></div>
                        <img src="build/img/blog4.jpg" alt="Entrada blog 4" loading="lazy">
                    </picture>
                </div>
                <div class="texto-entrada">
                    <a href="entrada.html">
                        <h4>Terraza en la azotea de tu casa</h4>
                        <p class="meta-info">Escrito el: <span>20/10/2023</span> por <span>Admin</span></p>
                        <p>Consejos para construir una terraza en la azotea de tu casa con los mejores materiales y ahorrando dinero.</p>
                    </a>
                </div>
            </article> <!-- .entrada-blog -->
        </section> <!-- .blog -->
    </main>

<?php
    incluirTemplate('footer');
?>