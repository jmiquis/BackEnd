<?php

class Cliente{

    private String $telefono;
    private String $nombre;
    private int    $puntos;


    public function __set($name, $value){$this->$name = $value;}
    public function __get($name) {return $this->$name;}

}
