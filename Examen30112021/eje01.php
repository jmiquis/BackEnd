<?php

$nombres = ["Juan","Pedro","María","Elena","Luis"];
$notas  = [7.5, 6.0, 7.8, 9.5, 3.5 ];
$calificaciones=[];
$datos=[];

//da valores a calificaciones
for ($i=0; $i < count($nombres); $i++) {
    $calificaciones[$nombres[$i]]=$notas[$i];
}

//calificaciones a datos
$datos[0]=array_keys($calificaciones);
$datos[1]=array_values($calificaciones);

echo "<code><pre>";
print_r($calificaciones);
print_r($datos);
echo "</pre></code>";

?>
