<?php
//inicio la matriz con todos los elementos a 0
$matriz=
[0=>array_fill(0,9,0),
 1=>array_fill(0,9,0),
 2=>array_fill(0,9,0)
];

//selecciono las columnas que van a atener solo 1 elemento
$columnasCon1Elemento=array_rand($matriz[0],3);

//selecciono en la primera de las columnas con 1 elemento la posicion de los numeros diferentes de 0
function rellenaColumna1($columnasCon1Elemento,&$matriz){
    $elementosArellenar=2;
    $columna=$columnasCon1Elemento[0];
    for ($i=0; $i <$elementosArellenar ; $i++) {
        $fila=random_int(0,2);
        $matriz[$fila][$columna]=random_int(0,9);
    }

}
rellenaColumna1($columnasCon1Elemento,$matriz);


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
    <?=var_dump($matriz)?>
</body>
</html>