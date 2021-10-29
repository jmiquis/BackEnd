<!DOCTYPE html>
<html lang="en">
<head>

    <?php
        session_start();
        require_once("app/funciones.php");

    ?>


    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <h1>La fruteria del siglo XXI</h1>



    <!-- si existe el nombre en la variable get -->
    <?php if(isset($_SESSION["nombre"])):?>

        <?php


            if (!isset($_POST["orden"])) {
                require_once("app/portal.php");
            }
            else{
                switch ($_POST["orden"]) {
                    case "anotar":
                        //si existen fruta y cantidad
                    if(isset($_POST["frutas"]) && isset($_POST["cantidad"])){

                        if(checkeoCantidad($_POST["cantidad"])){

                            //si la cantidad es correcta
                       generaCarrito($_POST["frutas"],$_POST["cantidad"]);
                       require_once("app/carrito.php");
                       require_once("app/portal.php");
                       break;
                        }
                        else{
                            require_once("app/carrito.php");
                            require_once("app/portal.php");
                            echo("la cantidad es erronea");
                            break;
                        }
                    }
                    case "terminar":
                        require_once("app/carrito.php");
                        session_destroy();
                        require_once("app/finalizarCompra.php");
                        break;
                }
            }
        ?>
    <!-- si no existe -->
    <?php else:?>



        <!-- se introduce el nombre -->
    <form action="index.php" method="GET">
        introduzca el nombre del cliente: <input type="text" name="nombre" id="">
    </form>

        <!-- y se crea la variable nombre -->
    <?php
        if(isset($_GET["nombre"])){
            if (!ctype_space($_GET["nombre"]) && !empty($_GET["nombre"])) {
                $_SESSION["nombre"]=noInyeccionHTML($_GET["nombre"]);
                header("location:index.php");
            }
            else {
                echo("nombre incorrecto");
            }
        }

    ?>
    <?php endif ?>

</body>
</html>