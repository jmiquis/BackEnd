
<?php


function accionDetalles($id){
    $usuario = $_SESSION['tuser'][$id];
    $nombre  = $usuario[0];
    $login   = $usuario[1];
    $clave   = $usuario[2];
    $comentario=$usuario[3];
    $orden = "Detalles";
    include_once "layout/formulario.php";
    exit();
}

function accionAlta(){
    $nombre  = "";
    $login   = "";
    $clave   = "";
    $comentario = "";
    $orden= "Nuevo";
    include_once "layout/formulario.php";
    exit();
}

function accionPostAlta(){

    if(evitaLoginDuplicados($_POST["login"])){
        limpiarArrayEntrada($_POST); //Evito la posible inyección de código
        $nuevo = [ $_POST['nombre'],$_POST['login'],$_POST['clave'],$_POST['comentario']];
        $_SESSION['tuser'][]= $nuevo;
    }
    else
        echo("<script>alert('Ya existe un login idéntico')</script>"); //codigo js
}
//borra la entrada del array de usuarios de SESSION
function accionBorrar($id){
   array_splice($_SESSION["tuser"],$id,1);
}

//muestra los datos aportados y da la opcion al usuario de cambiar la mayoria de los datos
function accionModificar($id){
    $usuario = $_SESSION['tuser'][$id];
    $nombre  = $usuario[0];
    $login   = $usuario[1];
    $clave   = $usuario[2];
    $comentario=$usuario[3];
    $orden = "Modificar";
    include_once "layout/formulario.php";
    exit();
}

//crea una variable array a modo de objeto y compara los campos cambiándolos si son diferentes en la variable SESSION
 function accionPostModificar($id){
   limpiarArrayEntrada($_POST);
   $usuarioPost=[];
    $usuarioPost[0]=$_POST["nombre"];
    $usuarioPost[1]=$_POST["login"];
    $usuarioPost[2]=$_POST["clave"];
    $usuarioPost[3]=$_POST["comentario"];

   foreach ($_SESSION["tuser"][$id] as $key => $value) {
       if ($value!==$usuarioPost[$key]) $_SESSION["tuser"][$id][$key] = $usuarioPost[$key];
   }
}





//termina la ejecucion
function accionTerminar(){
    volcarDatos($_SESSION["tuser"]);
    die("El sistema ha copiado los datos al archivo");
}
