
<h1>Gestion de pedidos del usuario <?=$user->getNombre()?> </h1>


<form action="<?=base_url?>usuario/userOrdersManagement" method="POST">
<input type="hidden" name="id"    value="<?=$user->getId()?>">
<input type="submit" name="query" value="todos los pedidos">




<!-- desplegable con direcciones del usuario-->
<p>buscar por direccion de entrega</p>
<select name="adress">
    <option value="%">cualquiera</option>
    <?php foreach ($user->getUserAdresses() as $key=>$adress):?>
        <option value="<?=$adress[0]?>"><?=$adress[0]?></option>
    <?php endforeach?>
</select>
<!-- desplegable con provinncias del usuario -->
<p>buscar por provincia de entrega</p>
<select name="region">
    <option value="%">cualquiera</option>
    <?php foreach ($user->getUserRegions() as $key=>$region):?>
        <option value="<?=$region[0]?>"><?=$region[0]?></option>
    <?php endforeach?>
</select>
<!-- desplegable con localidades del usuario -->
<p>buscar por localidad de entrega</p>
<select name="area">
    <option value="%">cualquiera</option>
    <?php foreach ($user->getUserAreas() as $key=>$area):?>
        <option value="<?=$area[0]?>"><?=$area[0]?></option>
    <?php endforeach?>
</select>
<!-- desplegable con estados de pedidos asociados al usuario -->
<p>buscar por estado de pedido</p>
<select name="status">
    <option value="%">cualquiera</option>
    <?php foreach ($user->getUserOrdersStatus() as $key=>$orderStatus):?>
        <option value="<?=$orderStatus[0]?>"><?=$orderStatus[0]?></option>
    <?php endforeach?>
</select>

<p>limite de coste total del pedido</p>
<input type="number" name="orderCost">

<p>busqueda por fecha limite</p>
<input type="date" name="date">

<input type="submit" name="query" value="busqueda filtrada">
</form>



<div class="ordersQueriesResults">

        <?php if($userOrdersQuery!==null):?>
            <?= Utils::printSQLTable($userOrdersQuery,$tableHeader);?>
        <?php else:?>
            <p>pulse un boton para examinar los pedidos del usuario</p>
        <?php endif?>

</div>

<button><a href="<?=base_url?>usuario/gestion"> volver </a></button>