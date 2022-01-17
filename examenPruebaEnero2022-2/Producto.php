<?php
    class Producto{

        private int $PRODUCTO_NO;
        private String $DESCRIPCION;
        private float $PRECIO_ACTUAL;
        private int $STOCK_DISPONIBLE;

        public function __get($name){return $this->$name;}
        public function __set($name, $value){$this->$name = $value;}

    }