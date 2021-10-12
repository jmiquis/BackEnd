<!-- Elaborar programa (01.php) en php que procese un formulario (01.html) que solicita al usuario un nombre y una clave. El programa php tendrá un array asociativo con 3 pares de valores de usuario => contraseña .  Se comprobará consultando la tabla si los datos son válidos, en este caso se debe mostrar un mensaje de bienvenida con nombre introducido , en otro caso se mostrar un mensaje de error para que usuario pueda volver a introducir nuevos datos. -->
<?php
const ARRAYPASSWORDS=["Jorge"=>"1234",
                      "Luis"=>"contraseña",
                      "Pedro"=>"hola"];
$nombre="";
$password="";
main();
function main(){
    if(comprobarNombre($nombre));
    if(comprobarPassword($password));
    if(comprobar($nombre,$password)){
        echo (pintaDatos($nombre,$password));
    }
    else{
        echo(errorAutenticacion());
        echo("<script>window.history.go(-1)</script>");
    }
}
function comprobarNombre(&$nombre){
    if (!empty($_POST["user"])) {
        $nombre=$_POST["user"];
        return true;
    }
    else{
        echo("el nombre no puede estar vacio");
        return false;
    }
}
function comprobarPassword(&$password){
    if (!empty($_POST["contra"])) {
        $password=$_POST["contra"];
        return true;
    }
    else{
        echo("La contraseña no puede estar vacia");
        return false;
    }
}



function comprobar($nombre,$password){
    return ARRAYPASSWORDS[$nombre]==$password;
}

function pintaDatos($nombre,$password){
    return "buenos dias ".$nombre;
}

function errorAutenticacion(){
    return '<script language="javascript">alert("error de autenticacion");</script>';
}




