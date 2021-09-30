<!-- 2.- Crear un array que almacene 5 cadenas con el nombre de periódicos y sus enlaces para acceder. El array será asociativo con el nombre del periódico como clave y su URL como valor.
3. elegir el favorito-->

<?php
 function generaPeriodicos(){
    $periodicos=[
        "El pais"=>"https://elpais.com/",
        "As"=> "https://as.com/",
        "El mundo"=>"https://www.elmundo.es/",
        "Marca"=> "https://www.marca.com/",
    ];
    return $periodicos;
}
function seleccionaFavorito($periodicos){
    $favorito=array_rand($periodicos,1);
    return $periodicos[$favorito];
}
$periodicos=generaPeriodicos();
$favorito=seleccionaFavorito($periodicos);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body{
            font-size: 40px;
        }
        td,tr,table,th{
            border: 1px black solid;
            border-collapse: collapse;
        }
    </style>
</head>
<body>
    <table>
        <tr>
            <th>periodico</th>
            <th>enlace</th>
        </tr>
        <?php foreach ($periodicos as $key => $value) :?>
            <tr>
                <td><?=$key?></td>
                <td><a href="<?=$value?>"><?=$value?></a></td>
            </tr>
        <?php endforeach?>
        <tr>
            <td>el medio favorito de hoy es:</td>
            <td><a href="<?= $favorito?>"><?= $favorito?></a></td>
        </tr>
    </table>
</body>
</html>