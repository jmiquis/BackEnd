<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>CRUD DE PRODUCTOS</title>
<link href="web/default.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="container" style="width: 600px;">
<div id="header">
<h1>GESTIÓN DE PRODUCTOS versión 1.1 + BD</h1>
</div>
<div id="content">
<hr>
<form   method="POST">
<table>
 <tr><td>numero de producto </td>
 <td>
 <input type="text" 	name="producto_no" 	    value="<?=$producto->PRODUCTO_NO     ?>"  <?= ($orden == "Detalles")?"readonly":"" ?> size="20" autofocus>              </td></tr>
 <tr><td>descripcion   </td> <td>
 <input type="text" 	name="descripcion" 	    value="<?=$producto->DESCRIPCION      ?>" <?= ($orden == "Detalles" || $orden == "Modificar")?"readonly":"" ?> size="8"></td></tr>
 <tr><td>precio </td> <td>
 <input type="text"     name="precio_actual"    value="<?=$producto->PRECIO_ACTUAL   ?>"  <?= ($orden == "Detalles")?"readonly":"" ?> size=10>                           </td></tr>
 <tr><td>stock </td><td>
 <input type="text" 	name="stock_disponible" value="<?=$producto->STOCK_DISPONIBLE ?>" <?= ($orden == "Detalles")?"readonly":"" ?> size=20>                           </td></tr>
 </table>
 <input type="submit"	name="orden" 	  value="<?=$orden?>">
 <input type="submit"	name="orden" 	  value="Volver">
</form>
</div>
</div>
</body>
</html>
<?php exit(); ?>
