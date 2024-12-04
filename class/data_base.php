<?php
/* @autor Thomas Cespedes */
try {
    $conector = new PDO("mysql:dbname=MIPROYECTO;host=localhost", "root", "");
       // echo "Conexion Exitosa";
} catch (Exception $ex) {
        echo "Fallo de conexion: " . $ex->getMessage();
}

class base_datos {
    private $gbd; //Objeto de conexion PDO
    
    // constructor para inicializar la conexion
    
    function __construct($driver, $base_datos, $host, $user, $pass) {
        // crear la cadena de conexion
        $conection = $driver . ":dbname=" .$base_datos . ";host=" . $host;
        //inicializar la conexion PDO
        $this->gbd = new PDO($conection, $user, $pass);
        //verificar la conexion
        if (!$this->gbd) {
            throw new Exception("No se ha podido realizar la conexion");
        } 
    }
    
    //metodo para realizar consultas SELECT
    function select($tabla, $filtros = null, $arr_prepare = null, $orden = null, $limit = null) {
        $sql = "SELECT * FROM " . $tabla;
        if ($filtros !=null) {
            $sql .= " WHERE " . $filtros;
        }
        if ($orden !=null) {
            $sql .= " ORDER BY " . $orden;
        }
        if ($limit != null) {
            $sql .= " LIMIT " . $limit;
        }
        $resource = $this->gbd->prepare($sql);
        $resource->execute($arr_prepare);
        if ($resource) {
            return $resource->fetchAll(PDO::FETCH_ASSOC);
        } else {
            throw new Exception("No se pudo realizar la consulta de seleccion");
        }
    }
    
    // metodo para realizar consultas INSERT
    function insert($tabla, $campos, $valores, $arr_prepare = null) {
        $sql = " INSERT INTO " . $tabla . " (" . $campos . ") VALUES (" . $valores . ")";
        $resource = $this->gbd->prepare($sql);
        $resource->execute($arr_prepare);
        
        if ($resource) {
            return $this->gbd->lastInsertId();
        } else {
            throw new Exception("No se pudo realizar la consulta de insercion");
        }
    }
    
    //metodo para realizar consultas UPDATE
    function update($tabla, $campos, $filtros, $arr_prepare = null) {
        
        $sql = " UPDATE " . $tabla . " SET " . $campos . " WHERE " . $filtros;
        $resource = $this->gbd->prepare($sql);
        $resource->execute($arr_prepare);
        
        if ($resource) {
            return true;
        } else {
            echo '<pre>';
            print_r($resource->errorInfo());
            echo '</pre>';
            throw new Exception("No se pudo realizar la consulta de actualizacion");
        }
    }
}
 ?>