<!-- 1.- Rellenar un array con 20 números aleatorios entre 1 y 10 y mostrar el contenido del array  mediante una tabla de una fila en HMTL. Mostrar a continuación el valor máximo, el mínimo y el  valor que mas veces se repite. (Nota definir funciones para cada caso) -->
<?php
function crearArray()
{
    for ($i=0; $i < 20; $i++) {
        $arrayNumeros[]=random_int(1,10);
    }
    return $arrayNumeros;
}

function hallaMayor($array){
    $max=0;
    for ($i=0; $i <count($array); $i++) {
        $max=($array[$i]>$max)?$array[$i]:$max;
    }
    return $max;
}
function hallaMinimo($array){
    $min=11;
    for ($i=0; $i <count($array); $i++) {
        $min=($array[$i]<$min)?$array[$i]:$min;
    }
    return $min;
}
function hallaMasRepetido($array){
    $aux=[];
    //recorre el array buscando el valor de $array en las claves de aux[]
    for ($i=0; $i <count($array); $i++) {
        $numero=$array[$i];
        if (!array_key_exists($numero,$aux)) {
          $aux[$numero]=1;
        }
        else{
            $aux[$numero]++;
        }
    }
    arsort($aux);
     foreach ($aux as $key => $value) {
        $devolver=$key;
        return $devolver;
     }
}
function pintaResultados(){
    $array=crearArray();
    $resultados=[];
    $resultados=array(
        "mayor" => hallaMayor($array),
        "menor" =>hallaMinimo($array),
        "masFrecuente" =>hallaMasRepetido($array),
    );
    return var_dump($resultados);
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
    <?= pintaResultados(); ?>
</body>
</html>