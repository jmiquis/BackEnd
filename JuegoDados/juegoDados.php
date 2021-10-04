<?php
$arrayDados=[];
$arrayDadosResultado=[];
$arrayDados=[
1=>"&#9856;",
2=>"&#9857;",
3=>"&#9858;",
4=>"&#9859;",
5=>"&#9860;",
6=>"&#9861;"
];
define("arrayDados",$arrayDados);
const ARRAYMENSAJES=["empate","ganador: jugador 1", "ganador: jugador 2"];

function generaArrayResultados(){
    for ($i=0; $i <count(arrayDados) ; $i++) {
        $dado=random_int(1,6);
        $arrayDadosResultado[]=$dado;
    }
    return $arrayDadosResultado;
}

function sumaResultado($resultado){
    $mayor=max($resultado);
    $menor=min($resultado);
    $mayorPasado=2;
    $menorPasado=2;
    $suma=0;

    foreach ($resultado as $value) {
        $mayorPasado=($value==$mayor)?$mayorPasado-1:$mayorPasado;
        $menorPasado=($value==$menor)?$menorPasado-1:$menorPasado;
        if ($value!=$mayor && $value!=$menor) {
            $suma+=$value;
        }
        elseif($value==$mayor && $mayorPasado<1){
            $suma+=$value;
        }
        elseif($value==$menor && $menorPasado<1){
            $suma+=$value;
        }

    }

    return $suma;
}


    function pintaDados($resultado){
        foreach ($resultado as $key => $value) {
           $dado=arrayDados[$value];
           echo("$dado");
        }
    }

    function partida($suma1,$suma2){
        $retorno=null;
        $resultadoPartida=$suma2-$suma1;
        if($resultadoPartida==0){
            return 0;
        }
        $retorno=($resultadoPartida<0)?1:2;
        return $retorno;
    }

    function pintaMensaje($partida){
       return ARRAYMENSAJES[$partida];
    }

    $jugador1=generaArrayResultados();
    $jugador2=generaArrayResultados();
    $suma1=sumaResultado($jugador1);
    $suma2=sumaResultado($jugador2);
    $partida=partida($suma1,$suma2);
    $color=colorVencedor($partida);

    function colorVencedor($partida){
        switch ($partida) {
            case 0:
                return "green";

            case 1:
                return "red";
            case 2:
                return "blue";
        }
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
        body{
            font-size: 50px;
        }
        .player1{
            color: red;
        }
        .player2{
            color: blue;
        }
        .resultado{
            color: <?=$color?>
        }
    </style>
</head>
<body>
    <table>
        <tr class="player1">
            <td >Jugador 1</td>
            <td><?php pintaDados($jugador1);?></td>
            <td><?=$suma1." puntos"  ?></td>
        </tr>
        <tr class="player2">
            <td>Jugador 2</td>
            <td><?php pintaDados($jugador2);?></td>
            <td><?=$suma2." puntos"  ?></td>
        </tr>
        <tr"><td class="resultado"><?=pintaMensaje($partida)?></td></tr>
    </table>
</body>
</html>