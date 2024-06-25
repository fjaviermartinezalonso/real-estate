<?php 

require 'funciones.php';
require 'config/database.php';
require __DIR__ . '/../vendor/autoload.php';

use App\Propiedad;
Propiedad::setDB(conectarDB()); // conexion base de datos para la clase