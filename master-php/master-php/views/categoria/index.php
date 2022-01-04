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
	</tr>
	<?php while($cat = $categorias->fetch_object()): ?>
		<tr>
			<td><?=$cat->id;?></td>
			<td><?=$cat->nombre;?></td>
			<td>
				<a href="<?=base_url?>categoria/categoriesManagement&id=<?=$cat->id?>" class ="button button-gestion">gestionar categoria</a>
			</td>
		</tr>
	<?php endwhile; ?>
</table>


