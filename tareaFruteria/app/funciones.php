
<?php
    //si no existen las variables las crea. Si existen suma la cantidad
    function generaCarrito($fruta,$cantidad){


        if (!isset($_SESSION["frutas"])) {
            $_SESSION["frutas"]=[];
        }

        if (!isset($_SESSION["frutas"][$fruta])) {
            $_SESSION["frutas"][$fruta]=0;
        }

        $_SESSION["frutas"]["$fruta"]+=$cantidad;
    }

    function checkeoCantidad($cantidad){
        $cantidad=intval($cantidad);
        if (!empty($cantidad) && is_numeric($cantidad) && is_int($cantidad) && !ctype_space($cantidad) && $cantidad>0){
            return true;
        }
        else
            return false;
    }

    //evita la inyeccion html

   function noInyeccionHTML($cadena):string{
    $cadena=trim($cadena); // Elimina espacios antes y después de los datos
    $cadena=stripslashes($cadena); // Elimina backslashes \
    $cadena=htmlspecialchars($cadena); // Traduce caracteres especiales en entidades HTML
    return $cadena;
 }

?>


