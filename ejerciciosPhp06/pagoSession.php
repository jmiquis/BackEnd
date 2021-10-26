<?php
    session_start();

    $sesionFinalizada=60;//segundos

    //comprueba si la sesion está en tiempo.Si no la cierra
    if (isset( $_SESSION["timeout"])) {

    //evalua el tiempo transcurrido
        if (time()-$_SESSION["timeout"]>$sesionFinalizada) {
            session_destroy();
            die("Sesion cancelada");
        }
    }
    //si no existe se crea con el tiempo de ahora mismo
    else {
        $_SESSION["timeout"]=time();
    }

    $carpeta='imagenes\\';
    $extension=".gif";

    //si existe un dato en get de la tarjeta lo mete en $SESSION[nuevaTarjeta]
    if(isset($_GET["nuevaTarjeta"])){
        $_SESSION["nuevaTarjeta"]=$_GET["nuevaTarjeta"];
    }

    session_destroy();

?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Forma de pago</title>
    </head>
    <body>
        <center>
	 <H2> SU FORMA DE PAGO ACTUAL ES</H2> </br>
         <?php if(isset($_SESSION["nuevaTarjeta"])):?>
            <img src="<?=$carpeta.$_SESSION["nuevaTarjeta"].$extension?>" alt=""></a>
         <?php else:?>
            <h1><?= "No hay ningun metodo de pago seleccionado"?></h1>
         <?php endif?>
         <h2>SELECCIONE UNA NUEVA TARJETA DE CREDITO </h2><br>
         <a href='pagoSession.php?nuevaTarjeta=cashu'><img  src='imagenes/cashu.gif' /></a>&ensp;
         <a href='pagoSession.php?nuevaTarjeta=cirrus1'><img  src='imagenes/cirrus1.gif' /></a>&ensp;
         <a href='pagoSession.php?nuevaTarjeta=dinersclub'><img  src='imagenes/dinersclub.gif' /></a>&ensp;
         <a href='pagoSession.php?nuevaTarjeta=mastercard1'><img  src='imagenes/mastercard1.gif'/></a>&ensp;
         <a href='pagoSession.php?nuevaTarjeta=paypal'><img  src='imagenes/paypal.gif' /></a>&ensp;
         <a href='pagoSession.php?nuevaTarjeta=visa1'><img  src='imagenes/visa1.gif' /></a>&ensp;
         <a href='pagoSession.php?nuevaTarjeta=visa_electron'><img  src='imagenes/visa_electron.gif'/></a>

        </center>
    </body>
</html>
