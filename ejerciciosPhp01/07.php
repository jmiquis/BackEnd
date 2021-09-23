<!-- 7. Elegir tres valores entre 100 y 500 y pintar tres barras de color rojo, verde y azul del tamaño indicado.
Pista: Utilizar  3 tablas con una fila del tamaño generado. -->


 <?php

         function FunctionName(){
            for ($i=0; $i < 3 ; $i++) {
                $long=random_int(500,1000);
                echo("
                     <table width='$long' class='tabla'>
                         <tr>
                             <td>&nbsp</td>
                         </tr>
                     </table>
                ");
             }
        }
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="2" />
    <link rel="stylesheet" type="text/css" href="07.css">
    <title>Document</title>
</head>
<body>
        <?php FunctionName();?>
</body>
</html>