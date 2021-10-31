<?php
    session_start();

    $nvisitas = 0;
    if (isset($_COOKIE["visitas"])){
        $nvisitas = $_COOKIE["visitas"];
    }

   require_once("app/funciones.php");



   if (!isset($_SESSION["dinero"])) {
       //entrada
      require_once("app/entrada.php");
      if (compruebaDinero()) {
          $_SESSION["dinero"]=$_GET["dinero"];
          $nvisitas++;
          setcookie("visitas", $nvisitas, time() + 30*24*3600);
          header("location:index.php");
      }

    }
    else {
        //apuesta

        if (!isset($_SESSION["apuesta"])||!isset($_SESSION["parImpar"])) {
            require_once("app/apuesta.php");

        if (isset($_POST["orden"])) {
            switch ($_POST["orden"]) {

                case 'hacer apuesta':
                    if (gestionaApuesta() && compruebaParImpar()){
                        $_SESSION["parImpar"]=$_POST["parImpar"];
                        $_SESSION["apuesta"]=$_POST["apuesta"];
                    //tirada
                    require_once("app/tirada.php");
                    $_SESSION["dinero"]=(tiradaCasino($_SESSION["parImpar"]))?$_SESSION["dinero"]+$_SESSION["apuesta"]:$_SESSION["dinero"]-$_SESSION["apuesta"];
                    unset($_SESSION["apuesta"]);
                    }
                    break;



               case "dejar el casino":

                mensajeDespedida();
                break;
            }
        }
        }
        if ($_SESSION["dinero"]<=0) {
            die("Lo sentimos, ha perdido todo su dinero");
        }
    }
