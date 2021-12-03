<?php

    //da valor al array
    $frutasSeleccionadas=[];

    if (isset($_COOKIE["frutas"]) && !empty($_COOKIE["frutas"]) ) {
        $frutasSeleccionadas=explode(",",$_COOKIE["frutas"]);
    }


    if (isset($_GET["boton"])) {

        //si la lista no esta en blanco
        if(isset($_GET["listafrutas"])){
            setcookie("frutas",implode(",",$_GET["listafrutas"]));
        }
        else{
        //si esta en blanco
        setcookie("frutas","");

        }
        header("location:eje03.php");
    }

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title> las frutas </title>
</head>
<body>
<form>
<fieldset>
<legend>Sus frutas preferidas </legend>
<label for="nombre">Lista de frutas:</label><br>
<select name="listafrutas[]" multiple >
<option value="Platano"     <?=(in_array("Platano",$frutasSeleccionadas))   ?"selected":""?>>Platano   </option>
<option value="fresa"       <?=(in_array("fresa",$frutasSeleccionadas))     ?"selected":""?>>fresa     </option>
<option value="Naranja"     <?=(in_array("Naranja",$frutasSeleccionadas))   ?"selected":""?>>Naranja   </option>
<option value="Melón"       <?=(in_array("Melón",$frutasSeleccionadas))     ?"selected":""?>>Melón     </option>
<option value="Manzana"     <?=(in_array("Manzana",$frutasSeleccionadas))   ?"selected":""?>>Manzana   </option>
</select>
<input type="submit" name="boton" value=" Cambiar ">
</fieldset>
</form>
</body>
</html>

