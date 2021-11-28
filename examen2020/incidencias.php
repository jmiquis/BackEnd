<?php


function noInyeccionHTML($cadena):string{
    $cadena=trim($cadena); // Elimina espacios antes y después de los datos
    $cadena=stripslashes($cadena); // Elimina backslashes \
    $cadena=htmlspecialchars($cadena); // Traduce caracteres especiales en entidades HTML
    return $cadena;
 }
require_once("claseIncidencia.php");
    $msg="";

if (isset($_POST["ordenar"])) {
    require_once("ordenarincidencias.php");
}

if (isset($_POST["nombre"]) && !empty($_POST["nombre"])){
    $limiteIncidencias=0;
    if (isset($_COOKIE["limiteIncidencias"])) {
        $limiteIncidencias=$_COOKIE["limiteIncidencias"];
    }
    $limiteIncidencias++;
    setcookie("limiteIncidencias",$limiteIncidencias,time()+120);

    if ($limiteIncidencias==5) {
        die("Necesita esperar un tiempo hasta que pueda volver a postear un inicidencia");
    }

    $nombreUsuario=noInyeccionHTML($_POST["nombre"]);
    $resumenIncidencia=noInyeccionHTML($_POST["resumen"]);
    $prioridad=noInyeccionHTML($_POST["prioridad"]);


    $IndicenciaAux=new Incidencia($nombreUsuario,$resumenIncidencia,$prioridad);




        if (!is_writable("incidencias.txt")){
            die("error al intentar abrir el archivo de datos");
        }

         if(@file_put_contents("incidencias.txt",implode(",",$IndicenciaAux->toString())."\n",FILE_APPEND)===false){
            $msg="Error no se ha podido anotar su incidencia";
        }
        else{
             $msg="Incidencia anotada con exito";
        }

}



    echo "<p> $msg </p>";
    



?>