<?php
include_once 'app/config.php';

// Cargo los datos segun el formato de configuración
function cargarDatos(){
    $funcion =__FUNCTION__.TIPO; // cargarDatostxt
    return $funcion();
}

function volcarDatos($valores){
    $funcion =__FUNCTION__.TIPO;
    $funcion($valores);
}

// ----------------------------------------------------
// FICHERO DE TEXT
//Carga los datos de un fichero de texto
function cargarDatostxt(){
    // Si no existe lo creo
    $tabla=[];

    if(!is_readable(FILEUSER))creaArchivoDatos(FILEUSER);

    $fich = @fopen(FILEUSER, 'r') or die("ERROR al abrir fichero de usuarios"); // abrimos el fichero para lectura

    while ($linea = fgets($fich)) {
        $partes = explode('|', trim($linea));
        // Escribimos la correspondiente fila en tabla
        $tabla[]= [ $partes[0],$partes[1],$partes[2],$partes[3]];
        }
    fclose($fich);
    return $tabla;
}
//Vuelca los datos a un fichero de texto
function volcarDatostxt($tvalores){

    if (!is_writable(FILEUSER)){ //si el archivo ni existe ni se tienen permisos de escritura
        die("error al intentar abrir el archivo de datos");
    }
    else{
    //borro el archivo de texto para evitar duplicacion de datos
    file_put_contents(FILEUSER,"");

    //para cada array con los datos de un usuario en SESSION le pone una linea al txt
    foreach ($_SESSION["tuser"] as $key => $value) {
            file_put_contents(FILEUSER,implode("|",$value)."\n",FILE_APPEND);
    }
    }



}

// ----------------------------------------------------
// FICHERO DE CSV

function cargarDatoscsv (){
    // Si no existe lo creo
   $tabla=[];

   if(!is_readable(FILEUSER))creaArchivoDatos(FILEUSER);

   $tabla=@file(FILEUSER);

   foreach ($tabla as $key => $value) {
      $tabla[$key]=str_getcsv($value);
   }
   return $tabla;

}

//Vuelca los datos a un fichero de csv
function volcarDatoscsv($tvalores){
    file_put_contents(FILEUSER,"");

    $flujoArchivoDatos=@fopen(FILEUSER,"r+") or die("error al abrir el fichero de datos .csv");
    foreach ($_SESSION["tuser"] as $key => $value) {
        fputcsv($flujoArchivoDatos,$value);
    }
    fclose($flujoArchivoDatos);
}

// ----------------------------------------------------
// FICHERO DE JSON
function cargarDatosjson (){
   // Si no existe lo creo
   $tabla=[];
   if(!is_readable(FILEUSER))creaArchivoDatos(FILEUSER);

   $stringJson=@file_get_contents(FILEUSER) or die("error al obtener datos del archivo json");

   return $arrayDatosJson=json_decode($stringJson,true); //devuelve el array asociativo correspondiente al string en formato json
}


function volcarDatosjson($tvalores){

  file_put_contents(FILEUSER,"");

  file_put_contents(FILEUSER,json_encode($_SESSION["tuser"]),LOCK_EX);

}




// MOSTRA LOS DATOS DE LA TABLA DE ALMACENADA EN AL SESSION
function mostrarDatos (){

    $titulos = [ "Nombre","login","Password","Comentario"];
    $msg = "<table>\n";
     // Identificador de la tabla
    $msg .= "<tr>";
    for ($j=0; $j < CAMPOSVISIBLES; $j++){
        $msg .= "<th>$titulos[$j]</th>";
    }
    $msg .= "</tr>";
    $auto = $_SERVER['PHP_SELF'];
    $id=0;
    $nusuarios = count($_SESSION['tuser']);
    for($id=0; $id< $nusuarios ; $id++){
        $msg .= "<tr>";
        $datosusuario = $_SESSION['tuser'][$id];
        for ($j=0; $j < CAMPOSVISIBLES; $j++){
            $msg .= "<td>$datosusuario[$j]</td>";
        }
        $msg .="<td><a href=\"#\" onclick=\"confirmarBorrar('$datosusuario[0]',$id);\" >Borrar</a></td>\n";
        $msg .="<td><a href=\"".$auto."?orden=Modificar&id=$id\">Modificar</a></td>\n";
        $msg .="<td><a href=\"".$auto."?orden=Detalles&id=$id\" >Detalles</a></td>\n";
        $msg .="</tr>\n";

    }
    $msg .= "</table>";

    return $msg;
}

/*
 *  Funciones para limpiar la entreda de posibles inyecciones
 */


// Función para limpiar todos elementos de un array
function limpiarArrayEntrada(array &$entrada) {
    foreach ($entrada as $key => $value) {
       htmlspecialchars($entrada[$key]);
    }
}

//comprueba que no existen 2 usuarios con el mismo login
function evitaLoginDuplicados($login){

    $columnaLogins=array_column($_SESSION["tuser"],1);

    if (in_array($login,$columnaLogins)) return false;

    return true;
}

//crea un archivo de datos
function creaArchivoDatos($nombreArchivo){
    // Si no existe lo creo
   if (!is_readable($nombreArchivo) ){
       // El directorio donde se crea tiene que tener permisos adecuados
       $fich = @fopen(FILEUSER,"w") or die ("Error al crear el fichero.");
       fclose($fich);
   }
}