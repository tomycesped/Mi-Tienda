<?php
include '../class/autoload.php';

if (isset($_POST['accion']) && $_POST['accion'] === 'guardar') {
    $miProducto = new Productos();
    $miProducto->nombre = $_POST['nombre_producto'];
    $miProducto->descripcion = $_POST['descripcion'];
    $miProducto->precio = $_POST['precio'];
    $miProducto->categoria = $_POST['categoria'];
    $miProducto->guardar();
} else if(isset($_GET['add'])) {
    include 'views/productos.html';
    die();
}

$lista_pro = Productos::listar();
include 'views/lista_productos.html';
?>