<!-- 7. Elegir tres valores entre 100 y 500 y pintar tres barras de color rojo, verde y azul del tamaño indicado.
Pista: Utilizar  3 tablas con una fila del tamaño generado. -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="2"/>
    <title>Document</title>
    <style>
        table, td, th {
	        border: 1px solid black;
}
        .tabla0{
            background-color: red;
        }
        .tabla1{
            background-color: blue;
        }
        .tabla2{
            background-color: green;
        }
    </style>
</head>
<body>
    <!-- tabla -->
    <?php for ($i=0; $i < 3 ; $i++):?>
        <?php $longitud=random_int(100,500);?>
        <table class="tabla<?=$i?>">
            <tr>
                <td width="<?=$longitud?>" height="40px"> &nbsp;</td>
            </tr>
        </table>
    <?php endfor?>
</body>
</html>