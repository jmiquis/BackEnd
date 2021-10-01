<?php
// Forma antigua de definir Array en PHP
$paises = array(
    'Francia' => array("Capital" => "París", "Poblacion" => "50000000"),
    'España' => array("Capital" => "Madrid", "Poblacion" => "42000000"),
    'Italia' => array("Capital" => "Roma", "Poblacion"   => "46000000"),
    'Argentina' => array("Capital" => "Buenos Aires", "Poblacion" => "40000000"),
    'Colombia' => array("Capital" => "Bogotá", "Poblacion"  => "36000000"),
    'Chile' => array("Capital" => "Santiago", "Poblacion"   => "36000000"),
    'Suecia' => array("Capital" => "Estocolmo", "Poblacion" => "25000000"),
);
//forma moderna
$ciudades = [
    'Francia' =>    ["París","Burdeos","Niza","Lille","Nantes"],
    'España' =>     ["Madrid", "Barcelona","León","Sevilla", "Valencia", "Málaga"],
    'Italia' =>     ["Roma", "Venecia","Florencia","Pisa", "Génova", "Milán", "Turín", "Nápoles"],
    'Argentina' =>  ["Buenos Aires", "Córdoba","Parana","Rosario"],
    'Colombia' =>   ["Bogotá", "Medellín","Cali","Barranquilla", "Bucaramanga"],
    'Chile' =>      ["Santiago", "Arica","Iquique","Osorno", "Viña del Mar"],
    'Suecia' =>   ["Estocolmo", "Upsala","Gotemburgo","Lund"],
  ];

  function paisMasPoblado($paises){
    $mayor="";
    $aux=0;
    foreach ($paises as $key => $value) {
      if($value["Poblacion"]>$aux){
         $aux=$value["Poblacion"];
         $mayor=$key;
      }
    }
    return $mayor;
  }

  $masPoblado=paisMasPoblado($paises);

  function obtenerArrayCiudades($masPoblado,$ciudades){
     return ($ciudades[$masPoblado]);
  }
  $arrayCiudades=obtenerArrayCiudades($masPoblado,$ciudades);

  function version2($paises){
    //obtengo array de columnas (valores de poblacion).
    $poblacion=array_column($paises,"Poblacion");
    //ordeno el array de columnas por clave y cojo el primero. De ahi cojo el valor de capital que se ha mantenido del
    //ordeno con multisort
    array_multisort($poblacion, SORT_DESC, $paises);
    return $paises;
  }
$arrayPaises2=version2($paises);
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
    <?=var_dump($arrayPaises2)?>
  </body>
  </html>