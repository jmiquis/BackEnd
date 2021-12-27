<h1>Gestion de pedidos del usuario <?=$usuario?> </h1>


<form action="<?=base_url?>usuario/userOrdersManagement">

<input type="submit" name="query" value="todos los pedidos">
<input type="submit" name="query" value="pedidos pendientes">


</form>

<div class="ordersQueriesResults">

</div>