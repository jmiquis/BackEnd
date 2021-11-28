<?php


$arrayDatos=[];
$arrayDatos2=[];

if (!empty("incidencias.txt")) {
   $arrayDatos=@file("incidencias.txt") or die("fallo al intentar abrir el archivo");
}
foreach ($arrayDatos as $key => $value) {
   array_push($arrayDatos2,explode(",",$value));
}

$arrayPrioridades=array_column($arrayDatos2,3);

array_multisort($arrayDatos2,SORT_DESC,$arrayPrioridades);

@file_put_contents("incidencias.txt","");

foreach ($arrayDatos2 as $key => $value) {
    file_put_contents("incidencias.txt",implode(",",$value),FILE_APPEND);
}

