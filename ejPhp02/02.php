<!-- Definir dos variables asignándoles un valor entero aleatorio entre 1 y 10, mostrar su suma, su resta, su división, su multiplicación, su módulo y su potencia (ciclo for), Crea un archivo llamado funcionesvar.php donde estén definidas las cinco operaciones: suma, resta, división, producto, módulo y potencia. Incluir ese fichero dentro de fichero principal (require_once) y llamar  a las funciones para obtener el resultado. -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once('funcionesvar.php');?>
    <title>Document</title>
</head>
<body>
    <?php
        suma($a,$b);
        resta($a,$b);
        multi($a,$b);
        division($a,$b);
        potencia($a,$b);
     ?>
</body>
</html>