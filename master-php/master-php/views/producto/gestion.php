<h1>Gestión de productos</h1>

<a href="<?=base_url?>producto/crear" class="button button-small">
	Crear producto
</a>

<a href="<?=base_url?>producto/salesManagement" class="button button-small">Gestión de ventas</a>

<?php if(isset($_SESSION['producto']) && $_SESSION['producto'] == 'complete'): ?>
	<strong class="alert_green">El producto se ha creado correctamente</strong>
<?php elseif(isset($_SESSION['producto']) && $_SESSION['producto'] != 'complete'): ?>
	<strong class="alert_red">El producto NO se ha creado correctamente</strong>
<?php endif; ?>
<?php Utils::deleteSession('producto'); ?>

<?php if(isset($_SESSION['delete']) && $_SESSION['delete'] == 'complete'): ?>
	<strong class="alert_green">El producto se ha borrado correctamente</strong>
<?php elseif(isset($_SESSION['delete']) && $_SESSION['delete'] != 'complete'): ?>
	<strong class="alert_red">El producto NO se ha borrado correctamente</strong>
<?php endif; ?>
<?php Utils::deleteSession('delete'); ?>

<table>
	<tr>
		<th>ID</th>
		<th>NOMBRE</th>
		<th>PRECIO</th>
		<th>STOCK</th>
		<th>VENTAS</th>
		<th>IMAGEN</th>
		<th>ACCIONES</th>

	</tr>
	<?php while($pro = $productos->fetch_object("Producto")): ?>
		<tr>
			<td><?=$pro->getId();?></td>
			<td><?=$pro->getNombre();?></td>
			<td><?=$pro->getPrecio();?></td>
			<td><?=$pro->getStock();?></td>
			<td><?=$pro->getTotalSoldsByProduct()?></td>
			<td><img src="<?=base_url?>uploads/images/<?=$pro->getImagen()?>" alt=""></td>
			<td>
				<a href="<?=base_url?>producto/editar&id=<?=$pro->getId()?>" class="button button-gestion">             Editar</a>
				<?php if(in_array($pro->getId(),Utils::getProductsInOpenOrders())):?>
					<p>producto en pedidos pendientes</p>
				<?php else:?>
					<a href="<?=base_url?>producto/eliminar&id=<?=$pro->getId()?>" class="button button-gestion button-red">Eliminar</a>
				<?php endif?>
			</td>
		</tr>
	<?php endwhile; ?>
</table>
