<?php

// $flujo=fopen("TareaCRUDFichero\dat\usuarios.csv","r+");
// fputcsv($flujo,["jorge","miquis","kkisjje","poopkde"]);
// fclose($flujo);
$archi=file("TareaCRUDFichero\dat\usuarios.csv");

$array=str_getcsv($archi[2]);

echo("hi");
?>