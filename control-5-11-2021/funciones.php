<?php


    //se da valor a las variables de sesion
      function asignancionVariablesSesion(){
        if(!isset($_SESSION["palabraSecreta"])){
            $_SESSION["palabraSecreta"]=generaPalabraSecreta();
        }
        if(!isset($_SESSION["letrasUsuario"])){
            $_SESSION["letrasUsuario"]="";
        }
        if (!isset($_SESSION["mensaje"])){
            $_SESSION["mensaje"]="";
        }
        if (!isset($_SESSION["fallos"])) {
            $_SESSION["fallos"]=0;
        }
    }


    //genera la palabra a adivinar
    function generaPalabraSecreta(){
        $arrayPalabras=["Madrid","Sevilla","Murcia","Bilbao","Londres","Paris"];
        return $arrayPalabras[random_int(0,count($arrayPalabras)-1)];
    }

    //genera la palabra con guones a mostrar
function palabraConGuiones($palabra,$letrasUsuario){
    $arrayConGuiones="";

    for ($i=0; $i <strlen($palabra) ; $i++) {
        $letra=$palabra[$i];
        $arrayConGuiones=(strpos($letrasUsuario,$letra)===false)?$arrayConGuiones."_":$arrayConGuiones.$letra;
    }
    return $arrayConGuiones;
}

//genera el final de la partida
function finalPartida($palabraConGuiones){
        global $partidasGanadas;
        $mensaje="";
        if($_SESSION["fallos"]>5){
            $mensaje="ha superado el numero de fallos permitido";
            echo($mensaje);
            session_destroy();

        return true;
        }
        if (strpos($palabraConGuiones,"_")===false) {
            $mensaje="enhorabuena, ha acertado la palabra";
            echo($mensaje);
            $partidasGanadas++;
            setcookie("partidasGanadas", $partidasGanadas, time() + 30*24*3600);
            session_destroy();
            return true;
        }
}


?>