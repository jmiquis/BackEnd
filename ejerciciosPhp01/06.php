<!-- Generar la  tabla de multiplicar de un número elegido al azar entre 1 y 10 con la siguiente apariencia  -->
<?php

//variables
$numero=0;
$resultado=0;

//number turns to random
$numero=random_int(1,10);

//for loop to create results
function generateResults($numero){
    for($i=0;$i<10;$i++){
        $resultado=$numero*$i;
        //generates a tr for each iteration
        echo("
                 <tr>
                     <td>$numero X $i =</td>
                     <td>$resultado</td>
                 </tr>
        ");

    }
}
?>
<!-- html -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="06.css">
    </head>
<body>
    <table class="primaryTable">
        <tr>
            <th class="primaryHead">tabla de multiplicar</th>
        </tr>
        <tr class="buttonTr">
           <td class=tableContainer>
           <table class="secondaryTable">
                 <?php generateResults($numero);?>
            </table>
           </td>
        </tr>
   </table>


</body>
</html>