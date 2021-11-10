<!-- 2. Realizar un programa (verfichero.php) donde podamos indicar un fichero de texto plano ( .txt, html o php por ejemplo) y que me lo muestre por pantalla, informando del número de caracteres y del número de líneas que contiene. -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="verifichero.php" method="POST">
inserte la ruta del archivo a mostrar:
<p><input type="text" name="archivo" id=""> </p>
<p><input type="submit" name="boton" value="obtener contenido"></p>
</form>

<?php

    $ruta="";
    $arrayArchivo=[];
    $contenido="";
    $contador=0;

    if(isset($_POST["boton"])){

    $ruta=$_POST["archivo"];
    //se abre el archivo
    $flujotxt=fopen($ruta,'r');
    //se crea el array con las lineas
    $arrayArchivo=file($ruta);
    //se trata
    foreach ($arrayArchivo as $key => $value) {
        $contador+=strlen($value);
        echo(htmlspecialchars($key."--".$value));
        echo("<br>");
    }
    echo("<br><br>el documento tiene ".$contador." letras y ".count($arrayArchivo)." lineas");
    //se cierra
    fclose($flujotxt);
}
?>

</body>
</html>