
<?php
    class BiciElectrica{
        private $id; // Identificador de la bicicleta (entero)
        private $coordx; // Coordenada X (entero)
        private $coordy; // Coordenada Y (entero)
        private $bateria; // Carga de la batería en tanto por ciento (entero)
        private $operativa; // Estado de la bicleta ( true operativa- false no disponible)


        public function __construct($id,$coordx,$coordy,$bateria,$operativa){
            $this->id=$id;
            $this->coordx=$coordx;
            $this->coordy=$coordy;
            $this->bateria=$bateria;
            $this->operativa=$operativa;
        }

        public function __toString(){
            return "identificador: ".$this->id." bateria : ".$this->bateria;
        }

        public function __get($name){
            return $this->$name;
        }

        public function __set($name, $value){
            $this->$name=$value;
        }

        public function distancia($puntoX, $puntoY) {
            return sqrt(pow($this->coordx-$puntoX,2)+pow($this->coordy-$puntoY,2));
        }




    }
?>