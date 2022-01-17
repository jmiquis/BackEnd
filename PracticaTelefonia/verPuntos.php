<?php
require_once 'accesoDatos.php';



 function allOk(){
    if (isset($_POST)){
        if(!empty($_POST['puntos'])){
            if($_POST['puntos']>0){
                return true;
            }
        }
    }
    return false;
}
function printResults($arrayResult){
    $msg = "<table><tr><th>telefono</th><th>nombre</th><th>puntos</th></tr>";
    if(count($arrayResult)>0){
        foreach ($arrayResult as $key => $cliente) {
            $msg.="<tr><td>".$cliente->telefono."</td><td>".$cliente->nombre."</td><td>".$cliente->puntos."</tr>";
        }
        return $msg."</table>";
    }
    return "no existen clientes con ese numero de puntos tan elevado";
}

if (allOk()){
    $db  = AccesoDatos::getModelo();
    $resultadoQuery = $db->getFilteredClients($_POST['puntos']);


    $resultado = printResults($resultadoQuery);
    require_once ('Index.php');

}