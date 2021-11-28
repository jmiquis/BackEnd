<?php
require_once("mibanco.php");
require_once("funcionesBanco.php");

$tablaMensajes=["Operacion realizada con éxito","Importe erróneo o importe menor de 0","Importe Erróneo o importe superior al saldo","su saldo actual es de " .$_SESSION['saldo']." euros"];


if (isset($_POST["Orden"])){
switch ($_POST["Orden"]) {
    case 'Ingreso':
        if (comprobarIngreso($_POST["importe"])) {
            accionIngreso($_POST["importe"]);
            $msg=$tablaMensajes[0];
        }
        else{
            $msg=$tablaMensajes[1];
        }
        break;
    case "Reintegro":
        if (comprobarReintegro($_SESSION["saldo"],$_POST['importe'])) {
            accionReintegro($_POST["importe"]);
            $msg=$tablaMensajes[0];
        }
        else{
            $msg=$tablaMensajes[2];
        }
        break;
        case "Ver saldo":
            $msg=$tablaMensajes[3];
            break;
        case "Terminar":
            session_destroy();
            die("gracias por utilizar nuestro banco");

}
header("Location: mibanco.php?msg=".urlencode($msg));
}

