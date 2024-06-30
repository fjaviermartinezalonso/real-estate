<?php

namespace App;

class ActiveRecord {

        // Conexion con la base de datos. Estática para compartirla entre todos los objetos
        protected static $db;
        protected static $columnasDB = [];
        protected static $errores = [];
        protected static $tabla = "";

        public function create() : bool {
            // Sanitizar los datos
            $atributos = $this->sanitize($this->atributos());

            // Insertar en la base de datos
            if(!is_null($this->id)) { // UPDATE
                $sets = [];
                foreach($atributos as $key => $value) {
                    $sets[] = "$key = '$value'";
                }
                $query = "UPDATE ";
                $query .= static::$tabla;
                $query .= " SET ";
                $query .= join(", ", $sets);
                $query .= " WHERE id = '$this->id'";
                return self::$db->query($query);
            }
            else { // CREATE
                $query = "INSERT INTO ";
                $query .= static::$tabla;
                $query .= " (";
                $query .= join(", ", array_keys($atributos));
                $query .= ") VALUES ('";
                $query .= join("', '", array_values($atributos));
                $query .= "')";
                return self::$db->query($query);
            }
        }

        public function deleteImage() {
            $url_imagen = IMAGENES_URL . $this->imagen;
            if(file_exists($url_imagen)) {
                unlink($url_imagen);
            }
        }

        public static function setDB($database) {
            self::$db = $database;
        }

        public function delete() {
            $query = "DELETE FROM ";
            $query .= static::$tabla;
            $query .= " WHERE id = ";
            $query .= self::$db->escape_string($this->id);
            $query .= " LIMIT 1";
            if(self::$db->query($query)) {
                $this->deleteImage(); // Eliminar imagen asociada de la base de datos
                header("location: /admin"); // si se logra recargamos página
            }
        }

        public function atributos() : array {
            $atributos = [];
            foreach(static::$columnasDB as $col) {
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
            return static::$errores;
        }

        public function validarCampos() {
            static::$errores = [];
        }

        public function setImage($image) {
            // Elimina imagen previa si se esta actualizando (hay id)
            if(!is_null($this->id)) {
                $this->deleteImage();
            }

            if($image) {
                $this->imagen = $image;
            }
        }

        public static function all() {
            $query = "SELECT * FROM ";
            $query .= static::$tabla; // static utiliza la tabla de la clase que heredo, en contraparte con self que seria siempre esta (campo vacio)
            return self::consultarSQL($query);
        }

        public static function find($id) {
            $query = "SELECT * FROM ";
            $query .= static::$tabla;
            $query .= " WHERE id = $id";
            return array_shift(self::consultarSQL($query)); // retornamos el unico objeto del array
        }

        public static function consultarSQL($query) {
            // Consultar base de datos
            $resultado = self::$db->query($query);

            // Iterar los resultados
            $array = [];
            while($registro = $resultado->fetch_assoc()) {
                $array[] = static::array2Propiedad($registro);
            }

            // Liberar la memoria del query
            $resultado->free();

            // Devolver resultado
            return $array;
        }

        protected static function array2Propiedad($registro) : self {
            $objeto = new static; // creamos objeto de la clase padre

            // iteramos array asociativo como par clave-valor
            foreach($registro as $key => $value) {
                if(property_exists($objeto, $key)) {
                    $objeto->$key = $value;
                }
            }

            return $objeto;
        }

        // Para sincronizar los campos mostrados con los introducidos por el usuario
        public function sincronizar($args) {
            foreach($args as $key => $value) {
                if(property_exists($this, $key) && !is_null($value)) {
                    $this->$key = $value;
                }
            }
        }
}