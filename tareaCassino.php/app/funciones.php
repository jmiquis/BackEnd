<?php


        //cantidad de dinero ok
        function checkeoDinero(int|float $cantidad):bool{
            $cantidad=intval($cantidad);
            return !empty($cantidad) && is_numeric($cantidad) && $cantidad>0;
        }

        function mensajeDespedida(){
            echo("Gracias por jugar. Su saldo al finalizar la sesion es de ".$_SESSION["dinero"]);
            session_destroy();
            die();
        }

        function compruebaDinero(){
            if (!isset($_GET["dinero"])) {
                echo("debe introducir una cantidad de dinero");
                return false;
            }
            elseif (!checkeoDinero($_GET["dinero"])) {
                echo("cantidad erronea");
                return false;
            }
            return true;
        }
        //apuesta

        function gestionaApuesta(){
            if (!isset($_POST["apuesta"])) {
                echo("es necesario que introduzca una apuesta");
                return false;
            }
            elseif (!checkeoDinero($_POST["apuesta"])) {
                echo("la cantidad introducida es erronea");
                return false;
            }
            elseif ($_POST["apuesta"]>$_SESSION["dinero"]) {
                echo("no tiene dinero suficiente para hacer esta apuesta");
                return false;
            }
            return true;
        }

        function compruebaParImpar(){
            if (!isset($_POST["parImpar"])) {
                echo("es necesario seleccionar par o impar");
                return false;
            }
            return true;
        }


        //tirada
        function tiradaCasino($parImpar){
            $numero=random_int(1,100);
            if ($parImpar="par" && $numero%2==0 || $parImpar=="impar" && $numero%2!=0) {
                $_SESSION["mensaje"]="Enhorabuena, ha ganado";
                $_SESSION["dinero"]+=$_SESSION["apuesta"];
            }
            else {
                $_SESSION["mensaje"]="Lo sentimos, ha perdido";
                $_SESSION["dinero"]-=$_SESSION["apuesta"];
            }

        }

?>