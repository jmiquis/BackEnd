<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="./05.php" method="POST">
    <p>nombre: <input type="text" name="nombre" required></p>
    <p>apellidos <input type="text" name="apellidos" required></p>
    <p>
        edad <select name="edad" id="">
            <option value="mayor">mayor de 55</option>
            <option value="menor">menor de 55</option>
        </select>
        </p>
    <p>
        sexo <input type="radio" name="sexo" id="" value="masculino"> masculino
             <input type="radio" name="sexo" value="femenino" default>femenino
    </p>
    hobbies
    <p><input type="checkbox" name="hobbies[]" id="" value="lectura">lectura</p>
    <p><input type="checkbox" name="hobbies[]" id="" value="ver la tele">ver la tele</p>
    <p><input type="checkbox" name="hobbies[]" id="" value="hacer deporte">hacer deporte</p>
    <p><input type="checkbox" name="hobbies[]" id="" value="salir de marcha">salir de marcha</p>

    <p><input type="submit" value="enviarDatos"></p>
    </form>
    <?php
    if ($_SERVER["REQUEST_METHOD"]=="POST") {
    function bienvenida(){
        if ($_POST["sexo"]=="masculino") {
            return "Bienvenido";
        }
        else return "Bienvenida";
    }

    function crearNombre(){
        $nombre=$_POST["nombre"]." ".$_POST["apellidos"];
        if ($_POST["edad"]=="mayor") {
            if ($_POST["sexo"]=="masculino") {
                $nombre="Don ".$nombre;
            }
            else{
                $nombre="Doña ".$nombre;
            }
        }
        return $nombre;
    }

    function crearAficiones(){
        if (!isset($_POST["hobbies"])) {
            return " no tiene ninguna aficion de nuestra lista.";
        }
        $aficiones=$_POST["hobbies"];

        $primeraParte=(count($aficiones)==1)?" .Su unica aficion es ":". Sus aficiones son ";
        $segundaParte="";
        foreach ($aficiones as $key => $value) {
            $segundaParte.=$value." ";
        }
        return $primeraParte." ".$segundaParte;
    }
    function checkSeguridad($cadena ){
        $cadena=trim($cadena); // Elimina espacios antes y después de los datos
        $cadena=stripslashes($cadena); // Elimina backslashes \
        $cadena=htmlspecialchars($cadena); // Traduce caracteres especiales en entidades HTML
        return $cadena;
        }



    $bienvenida=bienvenida();
    $nombre= crearNombre();
    $nombre=checkSeguridad($nombre);
    $aficiones=crearAficiones();

    echo("$bienvenida $nombre $aficiones");
    }
    ?>
</body>
</html>