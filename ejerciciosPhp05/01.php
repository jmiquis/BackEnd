<!-- Crea un archivo php llamado nif.php que solicite un número de de DNI y me muestre su letra NIF correspondiente, se tiene que comprobar tanto en la parte cliente como servidor que  el valor introducido esta formado solo por dígitos. La primera vez se mostrará el formulario y tras rellenar campo DNI se invocará al propio script php por  el método POST para que muestre la letra del NIF correspondiente.

Para saber que letra le corresponde a un número, se obtiene el resto de dividir el número entre 23 , y la letra almacenada en la posición indicada por el resto será la buscada. -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<?php if($_SERVER["REQUEST_METHOD"]=="GET"):?>
<body>
    <form action="01.php" method="post">
    <p>introduzca dni sin letra: <input type="number" name="numero" id=""></p>
    <p><input type="submit" value="calcular letra"></p>
    </form>
<?php else:?>
    <?php
        $numero=$_POST["numero"];
        define("arrayLetras",
                ['T','R','W','A','G','M','Y','F','P','D','X','B','N','J','Z','S','Q','V','H','L','C','K','E']
                );


        function calcularLetra($numero){
            return $letra=arrayLetras[$numero%23];
        }

        echo(is_numeric($numero))?"$numero-".calcularLetra($numero):"solo debe introducir numeros";
    ?>
    <?php endif?>
</body>
</html>

