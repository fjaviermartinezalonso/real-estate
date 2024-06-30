<?php

namespace App;

class Vendedor extends ActiveRecord {

    protected static $columnasDB = [
        "id", 
        "nombre", 
        "apellido",
        "telefono"
    ];
    protected static $tabla = "vendedores";

    public $id;
    public $nombre;
    public $apellido;
    public $telefono;

    public function __construct($args = []) {
        $this->id = $args["id"] ?? null;
        $this->nombre = $args["nombre"] ?? "";
        $this->apellido = $args["apellido"] ?? "";
        $this->telefono = $args["telefono"] ?? "";
    }

    public function validarCampos() {
        if(!$this->nombre) {
            self::$errores[] = "Campo Nombre requerido";
        }
        if(!$this->apellido) {
            self::$errores[] = "Campo Apellido requerido";
        }
        if(!$this->telefono) {
            self::$errores[] = "Campo Teléfono requerido";
        }
        if(!preg_match("/[0-9]{9}/", $this->telefono)) {
            self::$errores[] = "Campo Teléfono debe tener 9 dígitos";
        }
    }
}