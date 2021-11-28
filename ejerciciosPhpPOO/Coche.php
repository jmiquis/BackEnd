<?php
class Coche{

    private string $modelo="";
    private int $distanciaTotal=0;
    private int $distanciaParcial=0;
    private bool $motor=false;
    private int $velocidad=0;
    private int $velocidadMaxima=0;

    public function __construct(String $modelo,int $velocidadMaxima){

        $this->modelo=$modelo;
        $this->velocidadMaxima=$velocidadMaxima;
        $this->distanciaTotal=0;
        $this->distanciaParcial=0;
        $this->motor=false;
        $this->velocidad=0;

    }
    public function  arrancar():bool{
        if($this->motor){
            $this->infoError("el coche ya está arrancado");
            return false;
        }
        $this->motor=true;

        return true;
    }

    public function parar():bool{
        if(!$this->motor){
            $this->infoError("el coche ya está parado");
            return false;
        }
        $this->motor=false;
        $this->velocidad=0;
        return true;
    }

    public function acelera( int $cantidad):bool{
        if(!$this->motor){
            $this->infoError("El coche no puede acerlerar por no estar arrancado");
            return false;
        }
        $this->velocidad+=$cantidad;
        return true;
    }

    public function frena ( int $cantidad):bool{
        if(!$this->motor){
            $this->infoError("El coche no puede frenar por no estar arrancado");
            return false;
        }
        $this->velocidad=($this->velocidad-$cantidad<0)?0:$this->velocidad-$cantidad;
        return true;
    }

    public function recorre ():bool{
        if(!$this->motor){
            $this->infoError("El coche no puede moverse por no estar arrancado");
            return false;
        }

        if($this->motor){
        $this->distanciaParcial+=$this->velocidad;
        $this->distanciaTotal+=$this->distanciaParcial;
        }
        return true;
    }

    public function info():string{
        $mensaje="";
        foreach ($this as $key => $value) {
            $mensaje.="$key : $value <br>";
        }
        return $mensaje;
    }

    public function getKilometros():int{
        return $this->distanciaTotal;
    }

    private function infoError( String $mensaje):void{
        echo "<br>$mensaje<\br>";
    }

    public function __get($name){
        return $name;
    }

    public function __set($name, $value){
        $this->$name=$value;
    }
}



?>