<?php

namespace App;

class Propiedad {

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
            $this->id = $args["id"] ?? "";
            $this->titulo = $args["titulo"] ?? "";
            $this->precio = $args["precio"] ?? "";
            $this->imagen = $args["imagen"] ?? "";
            $this->descripcion = $args["descripcion"] ?? "";
            $this->habitaciones = $args["habitaciones"] ?? "";
            $this->baños = $args["baños"] ?? "";
            $this->estacionamientos = $args["estacionamientos"] ?? "";
            $this->creado = $args["creado"] ?? "";
            $this->vendedores_id = $args["vendedores_id"] ?? "";
        }
}
