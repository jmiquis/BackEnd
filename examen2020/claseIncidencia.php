<?php



class Incidencia{

        private String $nombreUsuario="";
        private String $timestamp;
        private String $descripcion="";
        private int $prioridad=0;
        private String $ip;

        public function __construct(
            $nombreUsuario,
            $descripcion,
            $prioridad
            ){

            $this->nombreUsuario=$nombreUsuario;
            $this->descripcion=$descripcion;
            $this->prioridad=$prioridad;
            $this->ip=$_SERVER["REMOTE_ADDR"];
            $this->timestamp=date("d-m-Y G:i:s",time());
        }
        public function __get($name){
            return $this->$name;
        }

        public function __set($name, $value){
            $this->$name=$value;
        }

        public function toString():Array{
            $objeto=[];
            foreach ($this as $key => $value) {
                $objeto[$key]=$value;
            }
            return $objeto;
        }
        public function comparaUrgencia(Incidencia $otra){
            $this->prioridad-$otra->prioridad;

        }




    }