
<!-- 5. Realizar y probar una  función que genere el código HTML de tablas con un borde determinado, incluyendo en cada casilla el mismo texto. -->
<?php require_once('funcionesvar.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php generarHTMLTable(3,3,"solid 1px black","hola"); ?>
</body>
</html>
