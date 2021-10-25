<!-- 1. La idea es que el usuario selecciona una tarjeta de crédito como medio de pago y que la aplicación la recuerde las siguientes veces que se invoque.  Haremos versiones diferentes pagocookie.php y pagosesion.php El primero gestionará la información mediante un cookie y el segundo mediante una sesión.

Usando pagocookie.php la selección de tarjeta se mantendrá mientras el cookie no se elimine o caduque aunque rearranquemos el navegador.

Usando pagosesion.php la selección de tarjeta se mantendrá mientras no cerremos el navegador o mientras no pase un tiempo fijado al crear la sesión.

La primera vez que el usuario invoque cualquiera de los dos programas se mostrará una página web con  siguiente información: -->
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Forma de pago</title>

        <?php
            if (isset($_GET["tarjetaFavorita"])) {
                setcookie("tarjetaFavorita",'imagenes/'.$_GET["tarjetaFavorita"].'.gif',time()+60);
                header("location:pagoCookie.php");
            }
        ?>
    </head>
    <body>
        <center>
	 <H2> SU FORMA DE PAGO ACTUAL ES</H2> </br>
        <?=isset($_COOKIE["tarjetaFavorita"])?"<img src='$_COOKIE[tarjetaFavorita]' /></a>":"no hay seleccionado ningun medio de pago";?>
         <h2>SELECCIONE UNA NUEVA TARJETA DE CREDITO </h2><br>
         <a href='pagoCookie.php?tarjetaFavorita=cashu'><img  src='imagenes/cashu.gif' /></a>&ensp;
         <a href='pagoCookie.php?tarjetaFavorita=cirrus1'><img  src='imagenes/cirrus1.gif' /></a>&ensp;
         <a href='pagoCookie.php?tarjetaFavorita=dinersclub'><img  src='imagenes/dinersclub.gif' /></a>&ensp;
         <a href='pagoCookie.php?tarjetaFavorita=mastercard1'><img  src='imagenes/mastercard1.gif'/></a>&ensp;
         <a href='pagoCookie.php?tarjetaFavorita=paypal'><img  src='imagenes/paypal.gif' /></a>&ensp;
         <a href='pagoCookie.php?tarjetaFavorita=visa1'><img  src='imagenes/visa1.gif' /></a>&ensp;
         <a href='pagoCookie.php?tarjetaFavorita=visa_electron'><img  src='imagenes/visa_electron.gif'/></a>
        </center>


    </body>
</html>
