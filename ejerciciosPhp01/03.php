<!-- Obtener un número al azar entre 1 y 9 y generar una pirámide con ese número de peldaños.
Utilizar la marca <code></code> para que la visualización no se deforme por el tamaño de los espacio o una estilo con tipo de letra monospace.
Número generado 5 -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <code>
        <?php

        $numero=random_int(1,10);
        $asteriscos=1;
        $blancos=$numero-1;

        echo("Numero generado= $numero <br><br>");
            //altura de la piramide
        for($i=0;$i<$numero;$i++){
            //movimiento por los peldaños
            for($j=0;$j<$numero*2-1;$j++){

                if($j>$blancos-1){
                    for($k=0;$k<$asteriscos;$k++){
                        echo("*");
                    }
                    echo("<br>");
                    break;
                }
                else{
                    echo("&nbsp");
                }

            }
            $asteriscos+=2;
            $blancos--;
            //salto de linea
            echo("<br>");
        }
        ?>

    </code>
</body>
</html>