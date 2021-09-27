<?php
define ('PIEDRA1',  "&#x1F91C;");
        define ('PIEDRA2',  "&#x1F91B;");
        define ('TIJERAS',  "&#x1F596;");
        define ('PAPEL',    "&#x1F91A;" );
    //funcion principal

            $jugador1=generaNumero();
            $pinta1=pintaSalida1($jugador1);
            $jugador2=generaNumero();
            $pinta2=pintaSalida2($jugador2);
            $tirada=tirada($jugador1,$jugador2);
            $arrayColores=colorResultado($tirada);
            $mensaje=generaMensajeVictoria($tirada);
         //evalua los numeros obtenidos
    function tirada($jugador1,$jugador2){
        if ($jugador1==$jugador2) {
            return 0;
        }
        else{
            if ($jugador1==1) {
                if ($jugador2==2) {
                    return 2;
                }
                else{
                    return 1;
                }
            }
            else if($jugador1==2){
                if ($jugador2==3) {
                    return 2;
                }
                else{
                    return 1;
                }
            }
            else if($jugador1==3){
                if($jugador2==1){
                    return 2;
                }
                else{
                    return 1;
                }
            }

        }
    }
        
    function generaNumero(){
        return random_int(1,3);
    }
    //pinta salida con piedra hacia la derecha
    function pintaSalida1($salida){
        switch ($salida) {
            case 1:
                return PIEDRA1;
            case 2:
                return PAPEL;
            case 3:
                return TIJERAS;
        }
    }
    //pinta salida con piedra hacia la izquierda
    function pintaSalida2($salida){
        switch ($salida) {
            case 1:
                return PIEDRA2;
            case 2:
                return PAPEL;
            case 3:
                return TIJERAS;
        }
    }
    // genera un color de celda segun el resultado
    function colorResultado($tirada){
        $color1="";
        $color2="";
        switch ($tirada) {
            case 0:
                $color1="green";
                $color2="green";
                break;
            case 1:
                $color1="green";
                $color2="red";
                break;
            case 2:
                $color1="red";
                $color2="green";
                break;
        }
        return $arrayColores=array($color1,$color2);
    }
     function generaMensajeVictoria($tirada){

       $mensaje=($tirada==0)?"Empate":"El ganador es el jugador  $tirada";
       return $mensaje;
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        td{
            font-size: 200px;
        }
        .jugador1{
            background-color: <?=$arrayColores[0]?>
        }
        .jugador2{
            background-color: <?=$arrayColores[1]?>
        }
        .mensajeJugador{
            font-size: 100px;
        }
        .mensaje{
            font-size: 50px;
        }
    </style>
    <title>Document</title>
</head>
<body>
    <table>
        <tr>
            <td class="jugador1">
                <div class="mensajeJugador">Player 1</div>
                <?=$pinta1?>
            </td>
            <td class="jugador2">
            <div class="mensajeJugador">Player 2</div>
            <?=$pinta2?>
            </td>
        </tr>
        <tr>
            <td class="mensaje" colspan="2"><?=$mensaje ?></td>
        </tr>
    </table>
</body>
</html>
