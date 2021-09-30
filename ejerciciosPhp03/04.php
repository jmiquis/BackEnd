<!-- 4. Crear una carpeta que se llame img y copiar en ella 5 ficheros de imágenes que muestre el logo de un deporte. Crear una array asociativo que almacene como clave el nombre del deporte y como valor la dirección de la imagen.
Mostrar una tabla HTML donde con el siguiente formato: -->
<!DOCTYPE html>
<?php
    $arrayImagenes=scandir("../ejerciciosPhp03/images/");
    $arrayImagenes=array_reverse($arrayImagenes,false);
    $arrayDeportes=["futbol","cricket","box","basket","ajedrez"];
    $arrayResultado=crearArray($arrayImagenes,$arrayDeportes);


     function crearArray($arrayImagenes,$arrayDeportes){
            $arrayResultado=[];
            for ($i=0; $i <count($arrayDeportes) ; $i++) {
                $clave=$arrayDeportes[$i];
                $valor=$arrayImagenes[$i];
                $arrayResultado[$clave]=$valor;

            }
            return $arrayResultado;
    }
?>
<style>
    .imagen{
        width: 200px;
        height: 100px;
    }
    table, td, tr{
        border-collapse: collapse;
        border: 1px solid black;
    }
</style>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

</head>
<body>
    <table>
        <?php foreach($arrayResultado as $key => $value):?>
            <tr>
                <td><?=$key?></td>
                <td ><img src="images/<?=$value?>" alt="" class="imagen"></td>
            </tr>
        <?php endforeach?>
    </table>
</body>
</html>