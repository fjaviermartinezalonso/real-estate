<?php 

require 'funciones.php';
require 'config/database.php';
require __DIR__ . '/../vendor/autoload.php';

use App\ActiveRecord;
ActiveRecord::setDB(conectarDB()); // conexion base de datos para la clase