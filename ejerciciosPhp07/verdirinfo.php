<!-- 3. Realizar un programa (verdirinfo.php) donde podamos indicar un nombre de directorio y me muestre los archivos que lo componen indicando el nombre, el tipo de archivo (MIME) y su tamaño en bytes. Mostrar la lista ordenada por tamaño. -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="verdirinfo.php" method="GET">
        <p>escriba el nombre del directorio: <input type="text" name="entrada"></p>
        <p><input type="submit" name="boton" value="aceptar"></p>
    </form>

    <?php
    $arrayResultado=[];

        if (isset($_GET["entrada"])) {
            //si es un directorio

            if (!is_dir($_GET["entrada"])) {
                die("la ruta no corresponde a un directorio");
            }
            //se crea una variable directorio
            if(!@opendir($_GET["entrada"])){
                die("error al generar la variable directorio");
            }
            else{
                $directorio=@opendir($_GET["entrada"],);
            }

            //se recorre y se trata
            do{
                $archivo=readdir($directorio);
                $rutaArchivo=$_GET["entrada"]."\\".$archivo;
                $arrayResultado[$archivo]=filesize($rutaArchivo);
            }while($archivo!=false);

            closedir($directorio);
            asort($arrayResultado);
            var_dump($arrayResultado);

        }
    ?>
</body>
</html>

