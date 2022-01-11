<h1>Bienvenido usuario <?=$clienteAux->nombre?>. Has entrado <?=$clienteAux->veces?> en nuestra web</h1>

<p>Esta es su lista de pedidos con codigo de cliente <?=$clienteAux->cod_cliente?></p>

<table>
<?php foreach($pedidos as $clave=>$pedido):?>
    <tr>
        <td><?=$pedido->producto?></td>
        <td><?=$pedido->precio?></td>
    </tr>
<?php endforeach?>
<tr><td>total pedidos</td><td><?=$total?></td></tr>
</table>