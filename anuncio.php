<?php
    include './includes/templates/header.php';
?>

    <main class="contenedor contenido-centrado">
        <h2>Casa de lujo frente al bosque</h2>

        <picture>
            <source srcset="build/img/destacada.webp" type="image/webp">
            <source srcset="build/img/destacada.jpeg" type="image/jpeg">
            <img src="build/img/destacada.jpg" alt="Foto de la propiedad" loading="lazy">
        </picture>
        
        <div class="resumen-propiedad">
            <p class="precio">800.000€</p>
            <ul class="iconos-caracteristicas">
                <li>
                    <img src="build/img/icono_wc.svg" alt="Icono WC" loading="lazy">
                    <p>3</p>
                </li>
                <li>
                    <img src="build/img/icono_estacionamiento.svg" alt="Icono estacionamiento" loading="lazy">
                    <p>3</p>
                </li>
                <li>
                    <img src="build/img/icono_dormitorio.svg" alt="Icono dormitorio" loading="lazy">
                    <p>4</p>
                </li>
            </ul> <!-- .iconos-caracteristicas -->

            <p>Casa en el lago con excelente vista, acabados de lujo a buen precio. Lorem ipsum dolor sit amet consectetur adipisicing elit. Quas corrupti itaque officiis eligendi maiores sunt. Dignissimos reiciendis suscipit unde quisquam rerum quis labore quos eaque ullam, accusantium ex quam natus! Lorem, ipsum dolor sit amet consectetur adipisicing elit. Rem odit similique rerum atque, in, ab aliquam repellat omnis enim quibusdam voluptatibus? Soluta cupiditate quibusdam accusamus error dolore possimus? Corporis, harum?</p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quas corrupti itaque officiis eligendi maiores sunt. Dignissimos reiciendis suscipit unde quisquam rerum quis labore quos eaque ullam, accusantium ex quam natus! Lorem, ipsum dolor sit amet consectetur adipisicing elit. Rem odit similique rerum atque, in, ab aliquam repellat omnis enim quibusdam voluptatibus? Soluta cupiditate quibusdam accusamus error dolore possimus? Corporis, harum?</p>
        </div>

    </main>

<?php
    include './includes/templates/footer.php';
?>