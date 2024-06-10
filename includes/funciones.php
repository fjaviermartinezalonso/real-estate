<?php

require 'app.php';

function incluirTemplate(string $nombre, bool $inicio = false) {
    include TEMPLATES_URL . "/$nombre.php";
}

function usuarioAutenticado() : bool {
    session_start();
    // Enviamos a la raíz si el admin no inició sesión
    if($_SESSION["login"]) {
        return true;
    }
    return false;
}