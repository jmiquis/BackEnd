<!-- 7. Crear otro programa que use estos datos  y elija dos paises al azar indicando sus datos y el  nombre de sus ciudades y un enlace generado a google map: ‘https://www.google.es/maps/place/’.$paiselegido -->
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
        }
    </style>
    <title>Document</title>
</head>
    <body>
        <table>
            <tr>
                <th>Pais</th>
                <th>Capital</th>
                <th>Poblacion</th>
                <th>Ciudades</th>
                <th>Enlace Google Maps</th>
            </tr>
            <?php for($i=0;$i<2;$i++):?> <!-- este ciclo hace que pinte dos lineas y elija 2 paises-->
                <tr>
                    <?php $paisAlAzar=eligePaisesAlAlzar($paises);?>
                    <td><?=$paisAlAzar?></td>
                    <!--pinto capital y poblacion -->
                    <?php foreach ($paises[$paisAlAzar] as $key => $value):?>
                        <td><?=$value?></td>
                    <?php endforeach?>
                    <!-- pinto las ciudades  -->
                    <td>
                        <?php foreach ($ciudades[$paisAlAzar] as $key => $value):?>
                            <?=$value." "?>
                        <?php endforeach?>
                    </td>
                    <!-- pinto el enlace -->
                        <td><a href=<?="https://www.google.es/maps/place/$paisAlAzar"?>><?="https://www.google.es/maps/place/.$paisAlAzar"?></a>
                    </td>
                </tr>
            <?php endfor?>
        </table>

    </body>
</html>