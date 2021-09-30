<!-- 5.  Realizar un programa en PHP que muestre un posible resultado de la bonoloto:
Se presentarán 6 números obtenidos aleatoriamente en el rango de 1 a 49 (ambos inclusives) Los 5 primeros forman la jugada ganadora y deberán presentar ordenados de menor a mayor en una tabla html; el sexto es el número complementario.  Por supuesto los números no pueden repetirse. -->
<?php
     function loteria(){
        $arrayLoteria=[];
        for ($i=0; $i < 6; $i++) {
            $numero=random_int(1,49);
            if (in_array($numero,$arrayLoteria)) {
                $i--;
            }
            else{
                $arrayLoteria[$i]=$numero;
            }
        }
        return $arrayLoteria;
    }
    $arrayLoteria=loteria();
    sort($arrayLoteria);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Document</title>
    <style>
          table, td, tr{
        border-collapse: collapse;
        border: 1px solid black;
        font-size: 50px;
    }
    </style>
</head>
<body>
    <table>
        <tr>
            <?php for ($i=0; $i < 5; $i++):?>
                <td><?=$arrayLoteria[$i] ?></td>
            <?php endfor ?>
            <td><?= "complementario ".$arrayLoteria[5]?></td>
        </tr>
    </table>
</body>
</html>