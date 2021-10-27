<!-- . Realizar el programa perfil.php que haciendo uso de cookies guarde en el navegador  la edad, sexo y deportes preferidos de un usuario durante una semana. El programa mostrará los valores almacenados mediante un formulario para que el usuario pueda modificarlos o borrarlos.  Si no existen los cookies se mostrará los campos en blanco. -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <?php
        if(isset($_COOKIE["deportes"])){
            $arrayDeportes=explode(",",$_COOKIE["deportes"]);
        }
    ?>

    <form action="perfil.php" method="get">
        <p>edad: <input type="number" name="edad" id="" value="<?=(isset($_COOKIE["edad"]))?$_COOKIE["edad"]:''?>"></p>
        <p>genero:
        masculino <input type="radio" name="genero" value="masculino" <?=(isset($_COOKIE["genero"])&& $_COOKIE["genero"]=="masculino")?"checked":"";?>>
        femenino <input type="radio" name="genero" value="femenino" <?=(isset($_COOKIE["genero"])&& $_COOKIE["genero"]=="femenino")?"checked":"";?>></p>
        <p>deportes:</p>
        <select name="deportes[]" id="" multiple>
            <option value="futbol"<?=(isset($arrayDeportes)&& in_array("futbol",$arrayDeportes))?"selected":""?>>futbol</option>
            <option value="baloncesto" <?=(isset($arrayDeportes)&& in_array("baloncesto",$arrayDeportes))?"selected":""?>>basket</option>
            <option value="tenis" <?=(isset($arrayDeportes)&& in_array("tenis",$arrayDeportes))?"selected":""?>>tenis</option>
            <option value="ping pong"<?=(isset($arrayDeportes)&& in_array("ping pong",$arrayDeportes))?"selected":""?>>ping pong</option>
        </select>
        <p><input type="submit" name="orden" value="almacenar datos">
            <input type="submit" name="orden" value="borrar datos"></p>
    </form>
    <?php if (isset($_GET["orden"])):?>

    <?php


        function crearCookies($tiempo){
            if (isset($_REQUEST["edad"])) {
                setcookie("edad",$_REQUEST["edad"],time()+$tiempo);
            }
            if (isset($_REQUEST["genero"])) {
                setcookie("genero",$_REQUEST["genero"],time()+$tiempo);
            }
            if(isset($_REQUEST["deportes"])){
                setcookie("deportes",implode(",",$_REQUEST["deportes"]),time()+$tiempo);
            }
        }

        if ($_GET["orden"]=="borrar datos") {
            crearCookies(-1);
        }
        elseif ($_GET["orden"]=="almacenar datos") {
            crearCookies(300);
        }
        header("location:perfil.php");
    ?>


    <?php endif?>
</head>
<body>

</body>
</html>