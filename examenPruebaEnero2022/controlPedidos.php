<?php

require_once 'accesoDatos.php';
require_once 'Cliente.php';
require_once 'Pedido.php';


    $_SESSION['login']  = "acceso denegado";
    $_SESSION['fallos'] = 0;

    if (isset($_GET['nombre']) && isset($_GET['pass'])){

        $nombre     = $_GET['nombre'];
        $password   = $_GET['pass'];
        $db         = AccesoDatos::getModelo();
        $clienteAux = $db->getUser($nombre);

        if ($clienteAux && $password === $clienteAux->clave){
            $_SESSION['login'] = "acceso permitido";
            $pedidos = $db->getOrdersByClient($clienteAux->cod_cliente);
            $clienteAux->veces++;
            $total = $clienteAux->getTotalOrders($pedidos);
            if($clienteAux->updateCliente());
            require_once 'vistaPedidos.php';
        }
        else{
            $_SESSION['fallos']++;
            echo "error de autenticacion";
            header("refresh:5; url=acceso.html" );
            die();
        }
}




?>