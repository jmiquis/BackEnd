<?php
require_once("biciElectrica.php");
//funciones

function cargaBicis(){
    $arrayBicis=[];
    //se crea un flujo y se le asiga a una variable
    $flujoArchivo=@fopen("datosBici.csv","r") or die("error al abrir el archvo csv");
    //una vez abierto lo recorro linea a linea con getcsv por ser csv. Cada linea es un objeto biciElectrica
    while ( $arrayPorCadaLinea=fgetcsv($flujoArchivo)) { //mientras que haya lineas se mantiene abierto el flujo
        //se valora si la bicicleta es o no operativa
        if ($arrayPorCadaLinea[4]==1){
        //al ser un array de objetos se le añade uno a uno los elementos con $nombreArray[]=new Objeto();
        $arrayBicis[]=new BiciElectrica($arrayPorCadaLinea[0],$arrayPorCadaLinea[1],$arrayPorCadaLinea[2],$arrayPorCadaLinea[3],$arrayPorCadaLinea[4]);
        }
    }
    //una vez se terminan las lineas se cierra el flujo del archivo
    fclose($flujoArchivo);

    return $arrayBicis;
}

function bicimascercana($puntoXUsuario,$puntoYUsuario,$tabla){

    $biciMasCercana=$tabla[0];
    $distanciaMinima=$tabla[0]->distancia($puntoXUsuario,$puntoYUsuario);

    foreach ($tabla as $key => $value) {
        if ($value->distancia($puntoXUsuario,$puntoYUsuario)<$distanciaMinima) {
            $biciMasCercana=$value;
        }
    }

    return $biciMasCercana;
}

function mostrartablabicis($tabla){
    $msg = "<table><th>Id</th><th>Coord X</th><th>Coord Y</th><th>Bateria</th>";
    foreach ($tabla as $bici) {
        $msg .= "<tr>";
        $msg .= "<td>$bici->id </td>\n";
        $msg .= "<td>$bici->coordx </td>\n";
        $msg .= "<td>$bici->coordy </td>\n";
        $msg .= "<td>$bici->bateria% </td>\n";
        $msg .= "</tr>";
    }
    $msg .= "</table>";

    return $msg;
}

// Programa principal
$tabla = cargaBicis();
if (!empty($_GET['coordx']) && !empty($_GET['coordy'])) {
$biciRecomendada = bicimascercana($_GET['coordx'], $_GET['coordy'], $tabla);
}

?>
<!DOCTYPE html>
<html>


<head>
<meta charset="UTF-8">
<title>MOSTRAR BICIS OPERATIVAS</title>
<style>
table, th, td {
border: 1px solid black;
border-collapse: collapse;
}
</style>

</head>

<body>
<h1> Listado de bicicletas operativas </h1>
<?= mostrartablabicis($tabla); ?>
<?php if (isset($biciRecomendada)) : ?>
<h2> Bicicleta disponible más cercana es <?= $biciRecomendada ?> </h2>
<button onclick="history.back()"> Volver </button>
<?php else : ?>
<h2> Indicar su ubicación: <h2>
<form>
Coordenada X: <input type="number" name="coordx"><br>
Coordenada Y: <input type="number" name="coordy"><br>
<input type="submit" value=" Consultar ">
</form>
<?php endif ?>
</body>

</html>
