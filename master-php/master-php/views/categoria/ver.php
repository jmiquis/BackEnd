<?php if (isset($categoria)): ?>
	<h1><?= $categoria->nombre?></h1>
	<?php if ($productos->num_rows == 0 ): ?>
		<p>No hay productos para mostrar</p>
	<?php else: ?>
		<div class="row">
		<?php while ($product = $productos->fetch_object()): ?>
			<div class="col-lg-4">
	<div class="card">

			<img src="<?=base_url."uploads/images/".$product->imagen?>" class="card-img-top" alt="<?=$product->imagen?>">
			<div class="card-body">
				<h5 class="card-title">
					<a style="color:black" href="<?=base_url?>producto/ver&id=<?=$product->id?>"><?=$product->nombre?></a>
				</h5>
				<p class="card-text"><?=$product->descripcion?>.</p>
			</div>

			<ul class="list-group list-group-flush">
				<li class="list-group-item"><?=$product->precio?> €</li>
				<?php if($product->oferta=="si"):?>
					<li class="list-group-item"> <del><p>precio anterior <?= Utils::getBargain($product->precio)?></p></del></li>
				<?php endif?>
			</ul>

		<div class="card-body">
				<?php if($product->stock > 0):?>
					<button type="button" class="btn btn-success"><a href="<?=base_url?>carrito/add&id=<?=$product->id?>" class="card-link">Comprar</a></button>

				<?php else:?>
					<button type="button" class="btn btn-danger"><a href="" class="card-link">No disponible</a></button>

				<?php endif?>
		</div>

	</div>
	</div>
		<?php endwhile; ?>
		</div>
	<?php endif; ?>
<?php else: ?>
	<h1>La categoría no existe</h1>
<?php endif; ?>
