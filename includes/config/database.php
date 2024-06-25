<?php

function conectarDB() : mysqli {
    $db = new mysqli('localhost', 'root', 'password', 'realstate_crud');

    if(!$db) {
        echo "ERROR al conectar con la base de datos";
        exit;
    }

    return $db;
}