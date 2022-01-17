<!DOCTYPE html>
<script type="text/javascript" src="checkNumber.js"></script>
<?php
require_once 'accesoDatos.php';
    $aux=AccesoDatos::getModelo();
    $max = $aux->getMax();
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <script lang="javaScript" src="checkNumber.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        table,th,td,tr{
            border: 1px black solid;
            border-collapse: collapse;
        }
    </style>
    <title>Document</title>
</head>
<body>
    <form action="verPuntos.php" method="post">
        introduzca el maximo de puntos para filtrar la busqueda : <input type="number" name="puntos" id="puntos">
        <input type="button" value="buscar" name="buscar" onclick='checkNumber("<?=$max?>")'><br><br><br>

    </form>

    <div>
        <?=(isset($resultado))?$resultado:"";?>
    </div>
</body>
</html>