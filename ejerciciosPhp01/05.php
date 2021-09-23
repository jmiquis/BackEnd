<!-- Realizar un segunda versión del primer ejercicio donde la página de resultado tiene que mostrar una tabla con el siguiente  formato utilizando estilo. -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style type="text/ccs">
        table{
            border: 1px solid black;
        }
    </style>
</head>
<body>
    <?php
        $numero1=random_int(1,10);
        $numero2=random_int(1,10);
        $numero2=random_int(1,10);
    ?>
    <table >
        <tr>
            <th>OPERACION</th>
            <TH>RESULTADO</TH>
        </tr>
        <tr>
            <td><?php echo("$numero1 + $numero2");?></td>
            <td><?php echo($numero1+$numero2);?></td>
        </tr>
        <tr>
            <td><?php echo("$numero1 - $numero2");?></td>
            <td><?php echo($numero1-$numero2);?></td>
        </tr>
        <tr>
            <td><?php echo("$numero1 / $numero2");?></td>
            <td><?php echo($numero1/$numero2);?></td>
        </tr>
        <tr>
            <td><?php echo("$numero1 % $numero2");?></td>
            <td><?php echo($numero1%$numero2);?></td>
        </tr>
        <tr>
            <td><?php echo("$numero1 ** $numero2");?></td>
            <td><?php echo($numero1**$numero2);?></td>
        </tr>
    </table>


</body>
</html>