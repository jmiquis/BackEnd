<?php
session_start();

function elegirPalabra(){
    static $tpalabras =["Madrid","Sevilla","Murcia","Málaga","Mallorca","Menorca"];
    $numeroAzar=random_int(0,count($tpalabras)-1);
   return $tpalabras[$numeroAzar];
}

function comprobarLetra($letra,$cadena){
    // Devuelve true o false si la letra esta en la cadena
    $comprobacion=strpos($cadena,$letra);

    return $comprobacion!==false;



}


/*
 * Devuelve una cadena donde aparecen las letras de la cadenapalabra en su posición    si cada letra se encuentra en la cadenaletras
 *
 * Ej  generaPalabraconHuecos("aeiou"     ,"hola pepe") -->"-o-a--e-e"
 *     generaPalabraconHuecos("abcdefghi ","hola pepe") -->"h--a -e-e"
 *
 */

function generaPalabraconHuecos ( $cadenaletras, $cadenapalabra) {

    // Genero una cadena resultado inicialmente con todas las posiciones con -
    $resu = $cadenapalabra;
    for ($i = 0; $i<strlen($resu); $i++){
        $resu[$i] = '*';
    }

    for ($j=0; $j < strlen($cadenapalabra) ; $j++) {
        $letra=$cadenapalabra[$j];
        if(comprobarLetra($letra,$cadenaletras)){
            $resu[$j]=$letra;
        }
    }

    return $resu;
}

function comprobarAciertos($palabraConGuiones){
    return comprobarLetra("*",$palabraConGuiones)===false;
}

 //se inicializan las variables siempre condicionadas a que no existan antes


if (!isset($_SESSION["letrasUsuario"])) $_SESSION["letrasUsuario"]=""; //se inicializa la variable que recoge los intentos

if (!isset($_SESSION["palabraSecreta"])) $_SESSION["palabraSecreta"]=elegirPalabra(); //selección de palabra secreta

if (isset($_GET["boton"])) {

    if(isset($_GET["letraUsuario"])) $_SESSION["letrasUsuario"].=$_GET["letraUsuario"];// se suma la letra a la variable session

}

if (!isset($_SESSION["fallos"])) $_SESSION["fallos"]=0; //se inicializan los fallos a 0

$palabraConGuiones=generaPalabraconHuecos($_SESSION["letrasUsuario"],$_SESSION["palabraSecreta"]);//se hace siempre y va cambiando

//se hace la comprobacion de si se ha terminado el juego

if ($_SESSION["fallos"]==5 || comprobarAciertos($palabraConGuiones)) {
    die("el juego ha finalizado");
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="index.php" method="GET">
        PALABRA: <?=$palabraConGuiones?>
        <p>Has cometido <?=$_SESSION["fallos"]?> errores</p>
        <p>Introduce una letra <input type="text" name="letraUsuario"></p>
        <p><input type="submit" name="boton" value="Comprobar letra"></p>
    </form>
</body>
</html>