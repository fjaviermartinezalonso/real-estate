<?php

namespace App;

class Propiedad extends ActiveRecord {

    protected static $columnasDB = [
        "id", 
        "titulo", 
        "precio", 
        "imagen", 
        "descripcion", 
        "habitaciones", 
        "baños", 
        "estacionamientos", 
        "creado", 
        "vendedores_id"
    ];
    protected static $tabla = "propiedades";

    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $baños;
    public $estacionamientos;
    public $creado;
    public $vendedores_id;

    public function __construct($args = []) {
        $this->id = $args["id"] ?? null;
        $this->titulo = $args["titulo"] ?? "";
        $this->precio = $args["precio"] ?? "";
        $this->imagen = $args["imagen"] ?? "";
        $this->descripcion = $args["descripcion"] ?? "";
        $this->habitaciones = $args["habitaciones"] ?? "";
        $this->baños = $args["baños"] ?? "";
        $this->estacionamientos = $args["estacionamientos"] ?? "";
        $this->creado = date("Y/m/d");
        $this->vendedores_id = $args["vendedores_id"] ?? "";
    }

    public function validarCampos() {
        if(!$this->titulo) {
            self::$errores[] = "Campo Título requerido";
        }
        if(!$this->precio) {
            self::$errores[] = "Campo Precio requerido";
        }
        if(!$this->imagen) {
            self::$errores[] = "Campo Imagen requerido";
        }
        if(!$this->descripcion) {
            self::$errores[] = "Campo Descripción requerido";
        }
        if(strlen($this->descripcion) < 50) {
            self::$errores[] = "La descripción requiere al menos 50 caracteres";
        }
        if(!$this->habitaciones) {
            self::$errores[] = "Campo Habitaciones requerido";
        }
        if(($this->habitaciones < 0) || ($this->habitaciones > 9)) {
            self::$errores[] = "El rango válido de Habitaciones es de 1 a 9";
        }
        if(!$this->baños) {
            self::$errores[] = "Campo Baños requerido";
        }
        if(($this->baños < 0) || ($this->baños > 9)) {
            self::$errores[] = "El rango válido de Baños es de 1 a 9";
        }
        if(!$this->estacionamientos) {
            self::$errores[] = "Campo Estacionamientos requerido";
        }
        if(($this->estacionamientos < 0) || ($this->estacionamientos > 9)) {
            self::$errores[] = "El rango válido de Estacionamientos es de 1 a 9";
        }
        if(!$this->vendedores_id) {
            self::$errores[] = "Campo Vendedor requerido";
        }
    }
}
