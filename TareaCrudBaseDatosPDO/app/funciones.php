<?php
require_once("accesoDatos.php");

// MUESTRA TODOS LOS USUARIOS
function mostrarDatos (){

    $titulos = [ "Numero Producto","Descripcion","Precio","Stock Disponible"];
    $msg = "<table>\n";
     // Identificador de la tabla
    $msg .= "<tr>";
    for ($j=0; $j < count($titulos); $j++){
        $msg .= "<th>$titulos[$j]</th>";
    }
    $msg .= "</tr>";
    $auto = $_SERVER['PHP_SELF'];
    $db = AccesoDatos::getModelo();
    $tablaProductos = $db->getTodosProductos();
    foreach ($tablaProductos as $Producto) {
        $msg .= "<tr>";
        $msg .= "<td>$Producto->PRODUCTO_NO</td>";
        $msg .= "<td>$Producto->DESCRIPCION</td>";
        $msg .= "<td>$Producto->PRECIO_ACTUAL</td>";
        $msg .= "<td>$Producto->STOCK_DISPONIBLE</td>";
        $msg .="<td><a href=\"#\" onclick=\"confirmarBorrar('$Producto->DESCRIPCION','$Producto->PRODUCTO_NO');\" >Borrar</a></td>\n";
        $msg .="<td><a href=\"".$auto."?orden=Modificar&id=$Producto->PRODUCTO_NO\">Modificar</a></td>\n";
        $msg .="<td><a href=\"".$auto."?orden=Detalles&id=$Producto->PRODUCTO_NO\" >Detalles</a></td>\n";
        $msg .="</tr>\n";

    }
    $msg .= "</table>";

    return $msg;
}

function limpiarEntrada(string $entrada):string{
    $salida = trim($entrada); // Elimina espacios antes y después de los datos
    $salida = strip_tags($salida); // Elimina marcas
    return $salida;
}
// Función para limpiar todos elementos de un array
function limpiarArrayEntrada(array &$entrada){

    foreach ($entrada as $key => $value ) {
        $entrada[$key] = limpiarEntrada($value);
    }
}