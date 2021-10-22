<?php
//api de google translator
require_once ('vendor/autoload.php');
use \Statickidz\GoogleTranslate;

//comprueba si la contraseña=usuario al reves y su longitud
 function usuarioOk($usuario, $contraseña) :bool {
    $usuario=noInyeccionHTML($usuario);
    $contraseña=noInyeccionHTML($contraseña);
   return strlen($usuario)>=8 && strrev($usuario)===$contraseña;
}
//obtiene la palabra mas repetida de una cadena

function palabraMasRepetida($cadena){
  $mensajeRetornado="";
  $cadena=noInyeccionHTML($cadena);
  $arrayDeCadena=explode(" ",$cadena);//forma un array con las palabras separadas con " "
  $valoresDeRepetidas=array_count_values($arrayDeCadena);// devuelve array con keys palabras y valores las veces repetidas
  asort($valoresDeRepetidas);//ordena por valores de manera descendente respetando la asociacion de keys
  $mensajeRetornado=array_key_last($valoresDeRepetidas);
  while($mensajeRetornado==" "){
   array_pop($valoresDeRepetidas);
   $mensajeRetornado=array_key_last($valoresDeRepetidas);
  }
return $mensajeRetornado;
}

//devuelve la letra mas repetida
function letraMasRepetida($cadena){
   $mensajeRetornado="";
   $cadena=noInyeccionHTML($cadena);
   $arrayDeCadena=str_split($cadena);//forma un array con las letras separadas
   $valoresDeRepetidas=array_count_values($arrayDeCadena);// devuelve array con keys palabras y valores las veces repetidas
   $mensajeRetornado=asort($valoresDeRepetidas);//ordena por valores de manera descendente respetando la asociacion de keys
   $mensajeRetornado=array_key_last($valoresDeRepetidas);
   while($mensajeRetornado==" "){
    array_pop($valoresDeRepetidas);
    $mensajeRetornado=array_key_last($valoresDeRepetidas);
   }
 return $mensajeRetornado;
}

//traduce al idioma deseado el comentario
function traducir($cadena){
$cadena=noInyeccionHTML($cadena);
$source = 'es';
$target = $_POST["idioma"];

$trans = new GoogleTranslate();
$result = $trans->translate($source, $target, $cadena);

echo $result;
}

//auxiliares

   //evita la inyeccion html

   function noInyeccionHTML($cadena):string{
      $cadena=trim($cadena); // Elimina espacios antes y después de los datos
      $cadena=stripslashes($cadena); // Elimina backslashes \
      $cadena=htmlspecialchars($cadena); // Traduce caracteres especiales en entidades HTML
      return $cadena;
   }
