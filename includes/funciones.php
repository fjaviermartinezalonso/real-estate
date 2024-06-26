<?php

define('TEMPLATES_URL', __DIR__ . '/templates');
define('FUNCIONES_URL', __DIR__ . 'funciones.php');
define('IMAGENES_URL', __DIR__ . "/../images/");
function incluirTemplate(string $nombre, bool $inicio = false) {
    include TEMPLATES_URL . "/$nombre.php";
}

function autenticarUsuario() {
    session_start();
    // Enviamos a la raíz si el admin no inició sesión
    if(!$_SESSION["login"]) {
        header("location: /");
    }
}

function debugVar($var) {
    echo "<pre>";
    var_dump($var);
    echo "</pre>";
}

function validarTipo($tipo) {
    $tipos = ["vendedor", "propiedad"];

    return in_array($tipo, $tipos);
}