<?php

     function anotar($cadena){
        if (!is_writable("contactos.txt")){ //si el archivo ni existe ni se tienen permisos de escritura
            return "error al intentar abrir el archivo de datos";
        }
        file_put_contents("contactos.txt",$cadena."\n",FILE_APPEND);
        return "contacto anotado";
    }


    function consultar($nombre){

        $flujoArchivo=@fopen("contactos.txt","r");

        while ($linea=(fgets($flujoArchivo))) {
            $aux=explode(",",$linea);
            if($aux[0]===$nombre)
                return "el telefono de $nombre es $aux[1]";
        }

        return "no se encuentra $nombre en la agenda";
    }

    $mensaje="";

    if(isset($_GET["orden"])){

        switch ($_GET["orden"]) {
            case 'Consultar':
                $mensaje=consultar($_GET["nombre"]);
                break;

            case 'Añadir':
                if(!is_numeric($_GET["telefono"])){
                    $mensaje="el telefono ha de ser numerico";
                    break;
                }
                if(empty($_GET["nombre"])){
                    $mensaje="el nombre no puede estar en blanco";
                    break;
                }

                $cadena=$_GET["nombre"].",".$_GET["telefono"];
                $mensaje=anotar($cadena);
                break;

        }



    }
?>

<html>
<head>
<meta charset="UTF-8">
<title> Agenda App </title>
</head>
<body>
<form>
<fieldset>
  <legend>Su agenda personal</legend>
    <label for="nombre">Nombre:</label><br>
    <input type='text' name='nombre' size=20 >
    <input type='submit' name="orden" value="Consultar"><br>
    <label for="telefono">Teléfono:</label><br>
    <input type='tel' name='telefono' size=20>
    <input type='submit' name="orden" value="Añadir">
</fieldset>
</form>
<p><?=$mensaje?></p>
</body>
</html>

