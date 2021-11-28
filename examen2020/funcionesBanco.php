<?php

// Si el usuario solicita Ingreso, el valor del importe tienen que ser un número positivo. En
// caso contrario se enviará el mensaje “Importe Erróneo o importe menor de 0 “.

function comprobarIngreso($cantidad):bool{
    if($cantidad<0 || empty($cantidad)){
        return false;
    }
    return true;
}

function accionIngreso($cantidad){
    $_SESSION['saldo']+=$cantidad;
}

// Si el usuario solicita Reintegro, el valor del importe tiene que ser un número entero positivo
// inferior o igual al saldo actual. En caso contrarío se enviará el mensaje “Importe Erróneo o
// importe superior al saldo”.
function comprobarReintegro($saldoTotal,$reintegro):bool{
    if($reintegro>$saldoTotal || $reintegro<0){
        return false;
    }
    return true;
}

function accionReintegro($cantidad){
    $_SESSION["saldo"]-=$cantidad;
}

?>