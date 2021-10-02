<!DOCTYPE html>
<?php require_once('infopaises.php')?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        table,th,tr,td{
            border: 1px black solid;
            border-collapse: collapse;
            size: 100px;
        }
        .barra{
            color:green;
        }
    </style>
    <title>Document</title>
</head>
<body>
    <table>
        <?php foreach ($ArrayTemperaturasYMeses as $key => $value):?>
            <tr>
                <td><?= $key ?></td>
                <td class=barra>
                    <?php for($i=0;$i<$value;$i++):?>
                        *
                    <?php endfor?>
                    <?=$value?>
                </td>
            </tr>
        <?php endforeach?>
    </table>
</body>
</html>