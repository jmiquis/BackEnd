<?php
session_start();
require_once("funciones.php");


$partidasGanadas = 0;

if (isset($_COOKIE["partidasGanadas"])){
    $partidasGanadas = $_COOKIE["partidasGanadas"];
}



//se le asignan las variables de sesion la primera vez que se inicia
asignancionVariablesSesion();
//se crea la variable cada vez para utilizarla sin los ciclos para generarlo
$palabraConGuiones=(isset($_SESSION["letrasUsuario"]))?palabraConGuiones($_SESSION["palabraSecreta"],$_SESSION["letrasUsuario"]):"";


require_once("formulario.php");

if (finalPartida($palabraConGuiones)) {
    require_once("boton.html");
    die();
}

if (isset($_GET["letraUsuario"])) {
    $_SESSION["letrasUsuario"].=$_GET["letraUsuario"];
    if (strpos($_SESSION["palabraSecreta"],$_GET["letraUsuario"])===false) {
        $_SESSION["fallos"]++;
    }
    header("location:index.php");
}


?>