<script type="text/javascript" src="<?=base_url?>assets/javascript/deleteCategoryJS.js"></script>
<h1>Gestionar categorias</h1>

<p><?=(isset($_SESSION['category_change']))? $_SESSION['category_change'] : '' ?></p><br><br>
<?php

Utils::deleteSession('category_change'); ?>

<a href="<?=base_url?>categoria/crear" class="button button-small">
	Crear categoria
</a>

<table>
	<tr>
		<th>ID</th>
		<th>NOMBRE</th>
		<th>DINERO GENERADO</th>
		<th>DINERO EN STOCK</th>
		<th>ACCIONES</th>
	</tr>
	<?php foreach($categorias as $key=>$value): ?>
		<tr>
			<td><?=$value->getId()?></td>
			<td><?=$value->getNombre()?></td>
			<td><?=$value->getTotalSold()?></td>
			<td><?=$value->getStockValue()?></td>

			<td>
				<a href="<?=base_url?>categoria/categoriesManagement&id=<?=$value->getId()?>" class ="button button-gestion">gestionar categoria</a>
	<?php if(!in_array($value->getId(),Utils::getCategoriesWithProducts())):?>

			<form action="<?=base_url?>categoria/deleteCategory" method="POST" id="<?=$value->getId()?>">
					<input type="hidden" name="id" value="<?=$value->getId()?>">
					<input type="button" value="eliminar categoria"onclick='deleteCategoryJS("<?=$value->getNombre()?>","<?=$value->getId()?>")'>
			</form>

     <?php else:?>
         <p>esta categoria contiene productos y no puede ser borrada</p><br><br>
     <?php endif?>
			</td>
		</tr>
	<?php endforeach?>
</table>


