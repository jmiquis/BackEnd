<!-- 2. Realizar el programa  adivina.php que haciendo uso de variables de sesión implemente un juego donde el usuario tenga que adivinar un número entre 1 y 20 teniendo 5 oportunidades para acertar. El programa le informará si el valor es inferior o superior al generado.
Cada vez que se accede el programa decrementará el número de oportunidades, si estas son cero indicará que el usuario ha perdido y que no puede realizar más intentos.

El programa ofrecerá en todo momento la posibilidad de generar una nueva partida. -->

<?php
    session_start();

    //si los intentos estan en session se cogen de ahi. Si no son 5
    $_SESSION["intentos"]=(isset($_SESSION["intentos"]))?$_SESSION["intentos"]:5;
    //si no existe el numero en sesion se crea
    $_SESSION["numero"]=(isset( $_SESSION["numero"]))? $_SESSION["numero"]:random_int(1,20);
    //lo mismo con la variable que da mensajes de estado
    $_SESSION["mensaje"]=(isset($_SESSION["mensaje"]))?$_SESSION["mensaje"]:"";


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
    <p>numero de intentos restantes: <p><?=$_SESSION["intentos"]?></p></p>
    <form action="adivina.php" method="get">
    <p>teclee el numero: <input type="text" name="entrada" id=""></p>
    <input type="submit" name="orden" value="prueba">
    <input type="submit" name="orden" value="reset">
    <p><textarea name="salida" id="" cols="30" rows="10"><?= $_SESSION["mensaje"]?></textarea></p>
    </form>

    <?php if(isset($_GET["orden"])):?>
        <?php

            function evaluaNumero($numeroAleatorio,$numeroUsuario){
                $mensaje="";
                return $mensaje=($numeroUsuario>$numeroAleatorio)?"tiene que ser mas bajo":"tiene que ser mas alto";
            }

            switch ($_GET["orden"]) {
                case 'reset':
                    // Cierra la sesion
                    session_destroy();
                    break;

                case "prueba":
                    if (empty($_GET["entrada"])) {
                        $_SESSION["mensaje"]="la entrada no puede estar vacia";
                    }
                    else{
                        $numeroUsuario=$_GET["entrada"];
                        $_SESSION["intentos"]--;

                        if (intval($numeroUsuario)===$_SESSION["numero"]) {
                            session_destroy();
                            die("Enhorabuena. Has acertado!!");
                        }
                        else {
                            $_SESSION["mensaje"]=evaluaNumero( $_SESSION["numero"],$numeroUsuario);
                            break;
                        }
                    }

            }
            if ($_SESSION["intentos"]<1) {
                session_destroy();
                die("lo sentimos, ha perdido");
            }
            header("location:adivina.php");
        ?>
    <?php endif?>
</body>
</html>
