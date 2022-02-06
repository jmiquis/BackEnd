<?php
session_start();

include_once 'app/funciones.php';
include_once 'app/acciones.php';

if(!isset($_SESSION['access'])){
    require_once 'app/layout/login.php';
    crearLogin();
    die();
}
if(!isset($_COOKIE['login'])){
    session_unset();
    header("Location:index.php");
}

// Div con contenido
$contenido="";
if ($_SERVER['REQUEST_METHOD'] == "GET" ){

    if ( isset($_GET['orden'])){
        if(!isset($_GET['id'])) $_GET['id']=[0,0,0,0,];
        switch ($_GET['orden']) {


            case "Nuevo"    : accionAlta(); break;
            case "Borrar"   : accionBorrar   ($_GET['id']); break;
            case "Modificar": accionModificar($_GET['id']); break;
            case "Detalles" : accionDetalles ($_GET['id']);break;
            case "Incrementar" : accionIncrementar ($_GET['id']);break;
            case "Bloqueos" : accionBloqueos ($_GET['id']);break;
            case "Terminar" : accionTerminar(); break;
        }
    }
}
// POST Formulario de alta o de modificación
else {
    if (  isset($_POST['orden'])){
         switch($_POST['orden']) {
             case "Nuevo"    : accionPostAlta(); break;
             case "Modificar": accionPostModificar(); break;
             case "Detalles":; // No hago nada
         }
    }
}
$contenido .= mostrarDatos();
// Muestro la página principal
include_once "app/layout/principal.php";




