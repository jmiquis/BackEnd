<?php
require_once "Producto.php";

function accionBorrar (int $producto_no){
    $db = AccesoDatos::getModelo();
    $tablaProductos = $db->borrarProducto($producto_no);
}

function accionTerminar(){
    AccesoDatos::closeModelo();
    die("Base de datos cerrada");
}

function accionAlta(){
    $producto = new Producto();
    $producto->PRODUCTO_NO      = "";
    $producto->DESCRIPCION      = "";
    $producto->PRECIO_ACTUAL    = "";
    $producto->STOCK_DISPONIBLE = "";
    $orden= "Nuevo";
    include_once "layoutProducto/formularioProducto.php";
}

function accionDetalles(int $numeroProducto){
    $db = AccesoDatos::getModelo();
    $producto = $db->getProductoConcreto($numeroProducto);
    $orden = "Detalles";
    include_once "layoutProducto/formularioProducto.php";
}


function accionModificar(int $numeroProducto){
    $db = AccesoDatos::getModelo();
    $producto = $db->getProductoConcreto($numeroProducto);
    $orden="Modificar";
    include_once "layoutProducto/formularioProducto.php";
}

function accionPostAlta(){
    limpiarArrayEntrada($_POST); //Evito la posible inyección de código
    $producto = new Producto();
    $producto->PRODUCTO_NO      = $_POST['producto_no'];
    $producto->DESCRIPCION      = $_POST['descripcion'];
    $producto->PRECIO_ACTUAL    = $_POST['precio_actual'];
    $producto->STOCK_DISPONIBLE = $_POST['stock_disponible'];
    $db = AccesoDatos::getModelo();
    $db->addProducto($producto);

}

function accionPostModificar(){
    limpiarArrayEntrada($_POST); //Evito la posible inyección de código
    $producto = new Producto();
    $producto->PRODUCTO_NO      = $_POST['producto_no'];
    $producto->DESCRIPCION      = $_POST['descripcion'];
    $producto->PRECIO_ACTUAL    = $_POST['precio_actual'];
    $producto->STOCK_DISPONIBLE = $_POST['stock_disponible'];
    $db = AccesoDatos::getModelo();
    $db->modificarProducto($producto);

}

