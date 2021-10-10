<?php
    $carton=[];

    //se inicia el carton con numeros colocados aleatorios
    function iniCarton(&$carton){
        for ($i=0; $i < 9 ; $i++) {
            $aleatorios=($i==0)?generaValoresAleatorios (1,9,3):generaValoresAleatorios (($i*10),($i*10)+9,3);
            for ($j=0; $j < 3 ; $j++) {
                $carton[$j][$i]=$aleatorios[$j];
            }
        }
    }
iniCarton($carton);

    //coloca 4 ceros en la primera fila aleatoriamente
    function colocaCeros(&$array){
        $columnasConCero=generaValoresAleatorios (0,8,4);
        for ($i=0; $i <count($columnasConCero) ; $i++) {
            $posicion=$columnasConCero[$i];
            $array[$posicion]=0;
        }
    }
    colocaCeros($carton[0]);


    //se seleccionan al azar las columnas que solo van a llevar un numero

    function columnasConUnNumero(&$array){
       return $huecosAleatorios=generaValoresAleatorios (0,8,3);
    }

    $aleatorias=columnasConUnNumero($carton[0]); //variable de posicion de columnas con dos huecos

    //recorre el primer array para que no haya elementos consecutivos iguales

    function noRepetidos($array,&$aleatorias){

        $aleatorias=columnasConUnNumero($array);
        for ($i=0; $i <count($array)-1 ; $i++) {
            if ($array[$i]==0 && $array[$i+1]==0 || $array[$i]!=0 && $array[$i+1]!=0) {

                //si los elementos iguales de la fila son un hueco y la columna tiene solo un hueco
                if ($array[$i]==0 && !in_array($i,$aleatorias) && !in_array($i+1,$aleatorias)){
                    return false;
                }
                //si los elementos no son huecos y las columnas tienen dos huecos
                elseif ($array[$i]!=0 && in_array($i,$aleatorias) && in_array($i+1,$aleatorias)){
                    return false;
                }
            }
        }
        return true;
    }

    //se repite hasta que no haya conflictos
    while(!noRepetidos($carton[0],$aleatorias)){
        noRepetidos($carton[0],$aleatorias);
    }

    //hace una primera pasada rellenando las posiciones seguras en las demas filas

    function primeraPasada(&$matriz,$aleatorias){
        for ($i=0;$i<count($aleatorias);$i++){ //recorre la primera fila
            $posicion=$aleatorias[$i];
            if ($matriz[0][$posicion]!=0) {//si la columna tiene dos huecos y la primera posicion no es un hueco las dos restantes si lo son
                    $matriz[1][$posicion]=0;
                    $matriz[2][$posicion]=0;
             }
        }
    }

    primeraPasada($carton,$aleatorias);

    //devuelve array con posibles posiciones

    function generaPosiciones($array,$aleatorias){
        $arrayPosiciones=[];
        for ($i=0; $i <count($array) ; $i++) {
            if (in_array($i,$aleatorias)&& $array[$i]==0 ||((!(in_array($i,$aleatorias))&& $array[$i]!=0))) {
                array_push($arrayPosiciones,$i);
            }
         }
         return $arrayPosiciones;
    }
    $arrayPosiciones=generaPosiciones($carton[0],$aleatorias);

    //coloca ceros en la fila del medio

    function ceros2(&$matriz,$arrayPosiciones){
        $veces=4-cuentaCeros($matriz[1]);
        //coge las columnas disponibles de manera alternativa para introducir 0 sin crear columnas repetidas
            for ($i=0,$j=0; $j <count($arrayPosiciones),$i<$veces;$i++, $j=$j+2) {
                $posicion=$arrayPosiciones[$j];
                $matriz[1][$posicion]=0;
            }
    }
    ceros2($carton,$arrayPosiciones);


    //evalua los valores de la tercera fila

    function teceraFila(&$matriz,$arrayPosiciones){
        for ($i=0; $i <count($arrayPosiciones) ; $i++) {
            $posicion=$arrayPosiciones[$i];
            $matriz[2][$posicion]=($matriz[1][$posicion]==0)?$matriz[2][$posicion]:0;
        }
    }
    teceraFila($carton,$arrayPosiciones);

    //funciones Auxiliares

    //proporciona array de n posiciones aleatorias ordenadas
    function generaValoresAleatorios ($inicioSerie,$finSerie,$numeroDeValores){
        $serieAleatoria=[];
        for ($i=$inicioSerie; $i <=$finSerie ; $i++) {
            $serieAleatoria[$i]="";
        }
        return array_rand($serieAleatoria,$numeroDeValores);
    }

    //cuenta los ceros en una fila
    function cuentaCeros($array){
        return array_count_values($array)[0];
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table,td,tr{
            font-size: 50px;
            border: 1px black solid;
            border-collapse: collapse;
            text-align: center;
        }
    </style>
</head>
<body>
    <table>
        <code>
            <?php foreach ($carton as $key => $value):?>
                <tr>
                    <?php foreach($value as $clave=>$valor):?>
                        <td>
                            <?php if($valor!=0):?>
                                <?= $valor?>
                            <?php else:?>
                                *
                            <?php endif?>
                        </td>
                    <?php endforeach?>
                </tr>
            <?php endforeach?>
        </code>
    </table>
</body>
</html>