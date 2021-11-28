<?php

class Reloj
{
    private $segundos=0;
    private bool $formato24=true;
    private bool $alarmaActivada=false;
    private RelojAlarma $alarma;


    public function __construct ( int $hora, int $minutos, int $segundos){

        $this->segundos=$segundos+($minutos*60)+($hora*3600);
    }

    // Mostrar la hora: genera un String con el  formado de hora  22:30:23
    // o 10:30:23 pm si el atributos Formato24 es falso

    public function mostrar(){
        $mediodia="";
        $funcionHoras=fn($segundos)=>floor($segundos/3600);
        $funcionMinutos=fn($segundos)=>floor($segundos/60);
        $funcionAjusteHoras=function($horas){
            while($horas>24){
                $horas-=24;
            }
            return $horas;
        };
        $segundos=$this->segundos;
        $horas=0;
        $minutos=0;

        if ($segundos>3600) {
            $horas=$funcionHoras($segundos);
            $horas=$funcionAjusteHoras($horas);
            $segundos=$segundos%3600;
            if ($segundos>60) {
                $minutos=$funcionMinutos($segundos);
                $segundos=$segundos%60;
            }
        }

        if($this->formato24==false){
            if($horas>12){
                $horas-=12;
                $mediodia="pm";
            }
            $mediodia="am";
        }



        return "$horas:$minutos:$segundos $mediodia <br>";

    }

    // Cambiar formato24, recibe un valor true si quiero formato de
    // 24 o falso si quiero de 12
    public function  cambiarFormato24( bool $formato24){
        $this->formato24=$formato24;
    }

    public function activarAlarma(bool $estado){
       $this->alarmaActivada=$estado;
    }

    public function setAlarma($horas,$minutos,$segundos){
       $this->alarma=new RelojAlarma($horas,$minutos,$segundos);
    }


    // Incrementa en un segundo el valor de reloj
    public function tictac (){
        $this->segundos++;
        if ($this->alarmaActivada) {
            if ($this->alarma->segundos===$this->segundos) {
                echo"ALARMA,ALARMA";
            }


        }

    }

    // Comparar Hora, recibe como parámetro otro objeto Reloj
    // y me devuelve el número de segundos que tienen de diferencia

    public function comparar ( Reloj $otroreloj){

        return abs($this->segundos-$otroreloj->segundos);

    }

}
