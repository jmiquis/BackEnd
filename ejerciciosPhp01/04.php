<!-- Generar números al azar entre 1 y 10 hasta que se generen 3 veces el valor 6 de forma consecutiva en ese caso se mostrará cuantos número se han generado. -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
            //variables
            $contador=0;
            $contador2=1;
            //ciclo infinito se rompe con tres 6
        while(true){
            $tiempoInicio=microtime(true);
            $numero1=random_int(1,10);

            $contador=($numero1==6)?($contador+1):0;
            if($contador==3){
                break;
            }
            $contador2++;
            $tiempoFinal=microtime(true);
        }
        echo("el programa ha sacado tres 6 tras $contador2 intentos en ".($tiempoInicio-$tiempoFinal). " milisegundos");
    ?>
</body>
</html>