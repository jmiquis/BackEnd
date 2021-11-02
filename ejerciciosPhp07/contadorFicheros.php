<!-- 1. Realizar programa php (contador.php) que muestre cuantas veces se ha accedido a la página en total y cuantas  veces desde un mismo navegador  trabajando sobre un fichero llamado accesos.txt y con un valor de cookie válido por tres meses. -->
<?php
$visitasGlobales=0;
$visitasLocales=0;
$archivoContador="contador.txt";

//si existe la cookie se le da el valor de la misma a la variable
if(isset($_COOKIE["visitasLocales"])){
    $visitasLocales=$_COOKIE["visitasLocales"];
}

$visitasLocales++;
setcookie("visitasLocales",$visitasLocales,time()+300);

//si existe y se puede leer el archivo se le da valor a la variable
if(is_readable($archivoContador)){
    if(!$visitasGlobales=@file_get_contents($archivoContador)){
        die("error al leer el archivo $archivoContador");
    }
}

$visitasGlobales++;

if(!@file_put_contents($archivoContador,$visitasGlobales)){
    die("error al leer el archivo $archivoContador");
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
    <p><?="numero de visitas desde este navegador= ".$visitasLocales;?></p>
    <p><?="numero de visitas totales= ".$visitasGlobales;?></p>
</body>
</html>