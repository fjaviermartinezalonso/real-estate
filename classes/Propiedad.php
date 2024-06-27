<?php

namespace App;

class Propiedad {

        // Conexion con la base de datos. Estática para compartirla entre todos los objetos
        protected static $db;
        protected static $columnasDB = ["id", "titulo", "precio", "imagen", "descripcion", "habitaciones", "baños", "estacionamientos", "creado", "vendedores_id"];
        protected static $errores = [];

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
            $this->creado = date("Y/m/d");
            $this->vendedores_id = $args["vendedores_id"] ?? "";
        }

        public function create() : bool {
            // Sanitizar los datos
            $atributos = $this->sanitize($this->atributos());

            // Insertar en la base de datos
            $query = "INSERT INTO propiedades (";
            $query .= join(", ", array_keys($atributos));
            $query .= ") VALUES ('";
            $query .= join("', '", array_values($atributos));
            $query .= "')";
            return self::$db->query($query);
        }

        public static function setDB($database) {
            self::$db = $database;
        }

        public function atributos() : array {
            $atributos = [];
            foreach(self::$columnasDB as $col) {
                if($col === "id") continue;
                $atributos[$col] = $this->$col;
            }
            return $atributos;
        }

        public function sanitize($atributos) : array {
            $sanitizado = [];
            foreach($atributos as $key => $value) {
                $sanitizado[$key] = self::$db->escape_string($value);
            }
            return $sanitizado;
        }

        public static function getErrores() {
            return self::$errores;
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

        public function setImage($image) {
            if($image) {
                $this->imagen = $image;
            }
        }

        public static function all() {
            $query = "SELECT * FROM propiedades";
            return self::consultarSQL($query);
        }

        public static function consultarSQL($query) {
            // Consultar base de datos
            $resultado = self::$db->query($query);

            // Iterar los resultados
            $array = [];
            while($registro = $resultado->fetch_assoc()) {
                $array[] = self::crearObjeto($registro);
            }

            // Liberar la memoria del query
            $resultado->free();

            // Devolver resultado
            return $array;
        }

        protected static function crearObjeto($registro) : self {
            $objeto = new self; // creamos objeto de la clase padre

            // iteramos array asociativo como par clave-valor
            foreach($registro as $key => $value) {
                if(property_exists($objeto, $key)) {
                    $objeto->$key = $value;
                }
            }

            return $objeto;
        }
}
