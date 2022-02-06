<?php
include_once "Usuario.php";

function accionBorrar ($login){
    $db = AccesoDatos::getModelo();
    $tuser = $db->borrarUsuario($login);
}

function accionTerminar(){
    AccesoDatos::closeModelo();
    session_destroy();
    header("Refresh:0 url='./index.php'");
}

function accionAlta(){
    $user = new Usuario();
    $user->nombre  = "";
    $user->login   = "";
    $user->password   = "";
    $user->comentario = "";
    $orden= "Nuevo";
    include_once "layout/formulario.php";
}

function accionDetalles($login){
    $db = AccesoDatos::getModelo();
    $user = $db->getUsuario($login);
    $orden = "Detalles";
    include_once "layout/formulario.php";
}


function accionModificar($login){
    $db = AccesoDatos::getModelo();
    $user = $db->getUsuario($login);
    $orden="Modificar";
    include_once "layout/formulario.php";
}

function accionPostAlta(){
    limpiarArrayEntrada($_POST); //Evito la posible inyección de código
    $user = new Usuario();
    $user->nombre  = $_POST['nombre'];
    $user->login   = $_POST['login'];
    $user->password   = $_POST['clave'];
    $user->comentario = $_POST['comentario'];
    $db = AccesoDatos::getModelo();
    $db->addUsuario($user);

}

function accionPostModificar(){
    limpiarArrayEntrada($_POST); //Evito la posible inyección de código
    $user = new Usuario();
    $user->nombre  = $_POST['nombre'];
    $user->login   = $_POST['login'];
    $user->password  = $_POST['clave'];
    $user->comentario = $_POST['comentario'];
    $db = AccesoDatos::getModelo();
    $db->modUsuario($user);

}

function accionIncrementar(){
    $arrayLogin = $_GET['id'];
    $db =AccesoDatos::getModelo();
    foreach($arrayLogin as $key=>$value){
        $db->incrementoSaldo($value);
    }
}


 function accionBloqueos(){

    $arrayLogin = $_GET['id'];
    $db = AccesoDatos::getModelo();
    $arrayUsers = $db->getUsuarios();
    $arrayLoginUsers =[];
    foreach ($arrayUsers as $clave=>$valor){
        $arrayLoginUsers[]=$valor->login;
    }

    foreach($arrayLoginUsers as $key=>$value){
        if(in_array($value,$arrayLogin)){
            $db->setBloqueo($value,1);
        }
        else{
            $db->setBloqueo($value,0);
        }
    }

}
