<?php
/* @autor Thomas Cespedes */
class Categorias {
        protected $id;
        public $nombre;
        private $exist = false;
        
        function __construct($id = null) {
            if ($id !=null) {
            $db = new base_datos("mysql", "MIPROYECTO", "localhost", "root", "");
            $resp = $db->select("categoria", "id=?", array($id));
            if (isset($resp[0]['id'])) {
                $this->id = $resp[0]['id'];
                $this->nombre = $resp[0]['nombre_categoria'];
                $this->exist = true;
                }
            }
        }
        
        public function mostrar() {
            echo "<pre>";
            print_r($this);
            echo "</pre>";
        }
        
        public function guardar() {
            if ($this->exist) {
                return $this->actualizar();
            } else {
                return $this->insertar();
            }
        }
        
        public function eliminar() {
            $db = new base_datos("mysql", "MIPROYECTO", "localhost", "root", "");
            return $db->delete("categoria", "id=?", array($this->id));
        }
        
        private function insertar() {
            $db = new base_datos("mysql", "MIPROYECTO", "localhost", "root", "");
            $resp = $db->insert("categoria", "nombre_categoria", "?", array($this->nombre));
            
            if ($resp) {
                $this->id = $resp;
                $this->exist = true;
                return true;
            } else {
                return false;
            }
        }
        
        private function actualizar() {
            $db = new base_datos("mysql", "MIPROYECTO", "localhost", "root", "");
            return $db->update("categoria", "nombre_categoria=?", "id=?", array($this->nombre, $this->id));
        }
        
        static public function listar() {
            $db = new base_datos("mysql", "MIPROYECTO", "localhost", "root", "");
            return $db->select("categoria");
        }
}