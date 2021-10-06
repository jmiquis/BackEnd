<!DOCTYPE html>
<?php
//genera un array de una fila para poner las posiciones de la tabla.Todas las posiciones se inicializan a [3,3]
function posicionesIni(){
    $posiciones=[];
        for ($i=0; $i <9 ; $i++) {
        $posiciones[$i]=[3,3];
        }
        return $posiciones;
}
$posiciones=posicionesIni();

//selecciona 3 columnas al azar para que solo tengan 1 numero
$columnasCon1Elemento=array_rand($posiciones,3);

//selecciona al azar la posicion de la columna donde va el numero que no es 0
function introduceCeros(&$posiciones,$columnasCon1Elemento){
    for ($i=0; $i <count($columnasCon1Elemento) ; $i++) {
        $posicion=$columnasCon1Elemento[$i];
        $posiciones[$posicion]=random_int(0,2);
    }
}
introduceCeros($posiciones,$columnasCon1Elemento);

//recorro otra vez el array en el resto de posiciones y le doy como valores a los arrays, las posiciones de la columna donde van los elementos!= a 0
function colocaNoCeros(&$posiciones){
    foreach ($posiciones as $key => $value) {
        if (is_array($value)) {
            $aleatorios=array_rand([0,1,2],2);//para evitar valores repetidos
             for ($i=0; $i <count($value) ; $i++) {
                 $posiciones[$key][$i]=$aleatorios[$i];
             }
        }
    }
}

colocaNoCeros($posiciones);

//esta funcion evalua si el siguiente elemento es igual al actual y lo cambia, distinguiendo entre arrays o numeros

function eliminaRepetidas(&$posiciones){
    for($i=0;$i<count($posiciones)-1;$i++){
        if($posiciones[$i]===$posiciones[$i+1]){
            if (is_array($posiciones[$i])) {
                do{
                    for ($j=0; $j <count($posiciones[$i+1]) ; $j++) {
                        $aleatorios=array_rand([0,1,2],2);//para evitar valores repetidos
                        $posiciones[$i+1][$j]=$aleatorios[$j];
                    }
                }while($posiciones[$i]===$posiciones[$i+1]);
            }
            else{
                do{
                    $posiciones[$i+1]=random_int(0,2);
                }while($posiciones[$i]===$posiciones[$i+1]);
            }
        }
    }
}
eliminaRepetidas($posiciones);

//inicia una matriz que representa un carton con todos los elementos a 0
 function iniCarton(){
    $carton=[];
    for ($i=0; $i <3 ; $i++) {
        $carton[$i]=array_fill(0,9,0);
    }
    return $carton;
}
$carton=iniCarton();


//recorre el array de posiciones pintando uno o dos numeros en el carton
function rellenaCarton(&$carton,$posiciones){
foreach ($posiciones as $key => $value) {
    $columna=$key;
    if (is_array($value)) {
        for ($i=0; $i <count($value) ; $i++) {
            $fila=$value[$i];
            $numero=($columna==0)?random_int(1,10):random_int(($columna*10),$columna*10+9);
            $carton[$fila][$columna]=$numero;
        }
    }
    else{
        $fila=$value;
        $numero=($columna==0)?  random_int(1,10):random_int(($columna*10),$columna*10+9);
        $carton[$fila][$columna]=$numero;
    }
}
}
rellenaCarton($carton,$posiciones);
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table>
        <?php foreach ($carton as $key => $value):?>
            <tr>
                <?php foreach($value as $clave=>$valor):?>
                    <td>
                        <?=$valor?>
                    </td>
                <?php endforeach?>
            </tr>
        <?php endforeach?>
    </table>
</body>
</html>