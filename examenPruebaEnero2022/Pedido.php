<?php

class Pedido{

   private int $numped;
   private int $cod_cliente;
   private String $producto;
   private int $precio;
   private AccesoDatos $db;

   public function __get($name){return $this->$name;}
   public function __set($name, $value){$this->$name = $value;}
   public function __construct(){
    $this->db = AccesoDatos::getModelo();
   }
}