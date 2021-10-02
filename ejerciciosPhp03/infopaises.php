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
    //ordeno el array de columnas por clave y cojo el primero.
    //ordeno con multisort
    array_multisort($poblacion, SORT_ASC, $paises);
    return $paises;
  }
$arrayPaises2=version2($paises);

//Halla la primera clave
function hallarMayorv2($arrayPaises2,$ciudades){
    $paisMasPoblado=array_key_last($arrayPaises2);
    return $ciudades[$paisMasPoblado];
}
$resultado2=hallarMayorv2($arrayPaises2,$ciudades);

//me devuelve un array con dos claves al azar
function eligePaisesAlAlzar($paises){
  return array_rand($paises);
}


//genera un array mergeado si esxsiten las mismas claves
function mergearArrays($paises,$ciudades){
  return array_merge_recursive($paises,$ciudades);

}
$arraymergeado=mergearArrays($paises,$ciudades);

