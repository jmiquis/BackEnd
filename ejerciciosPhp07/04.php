<!-- 4. Realizar un programa (contarprogramas.php) donde podamos indicar  indicar un nombre de directorio y me muestre el nombre de los archivos con extensión .php, indicándome cuantas líneas de código tiene cada fichero y el total de lineas del directorio. -->


<?php
$contadorLineas=0;

if (isset($_GET["boton"]) && isset($_GET["directorio"])) {
    //se comp`rueba si es un directorio válido
    if(!@is_dir($_GET["directorio"])){
        die("El directorio no es correcto");
    }
    else{
        //se abre el flujo. Si devuelve false se termina con die
        $flujoDirectorio = @opendir($_GET["directorio"]) or die("Error al abrir el directorio");
    }

    do {
        //se abre el directorio
        $archivo=@readdir($flujoDirectorio);

        $ruta=$_GET["directorio"]."/".$archivo;
        //si la extension es php
        if (pathinfo($ruta,PATHINFO_EXTENSION)==="php") {
            $archivoPhp=file($ruta); //se convierte a array
            $contadorLineas+=count($archivoPhp);//suma lineas del archivo al contador total
            echo("<table style='border: 1px solid black'>");
            echo("<tr><td>el archivo $ruta tiene ".count($archivoPhp)." lineas de codigo</td></tr>");
            echo("</table>");
        }
    } while ($archivo);

    //cierro el flujo del directorio
    closedir($flujoDirectorio);

    echo("<br><br> el total de lineas PHP del directorio". $_GET["directorio"]." es de $contadorLineas");
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
   <form action="04.php" method="get">
    <p>introduzca el nombre del directorio: <input type="text" name="directorio"></p>
    <p><input type="submit" name="boton" value="empezar"></p>
   </form>
</body>
</html>