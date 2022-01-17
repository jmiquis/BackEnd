<!DOCTYPE html>

<?php
require_once 'accesoDatos.php';
require_once 'Producto.php';

    $modelo = accesoDatos::getModelo();
    $msg    = "";

 function everythingOK() {
    return isset($_POST['accion']) && isset($_POST['id']);
 }




    if(everythingOK()){
        if(isset($_COOKIE['bloqueo'])){
            $msg = "no puede efectuar mas descuentos por hoy";
        }
        else{
        $modelo->updateProducts($_POST['id']);
        setcookie("bloqueo",time()+(3600*24));
        }
    }




?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
        <form action="" method="POST">
            <p><?=$msg?></p>
                <table>
                    <?php foreach($modelo->getProducts() as $key=>$value):?>
                        <tr>
                            <td>
                                <input type="checkbox" name="id[]" value="<?=$value->PRODUCTO_NO?>" >
                            </td>
                            <td><?=$value->PRODUCTO_NO?></td>
                            <td><?=$value->DESCRIPCION?></td>
                            <td><?=$value->STOCK_DISPONIBLE?></td>
                            <td><?=$value->PRECIO_ACTUAL?></td>
                        </tr>
                    <?php endforeach?>
                </table>
                <input type="submit" name="accion" value="actualizar">
        </form>
</body>
</html>