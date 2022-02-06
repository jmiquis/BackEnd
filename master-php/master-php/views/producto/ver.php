
<?php if (isset($product)): ?>
	<h1><?= $product->nombre ?></h1>
	<div id="detail-product">
		<div class="image">
			<?php if ($product->imagen != null): ?>
				<img src="<?= base_url ?>uploads/images/<?= $product->imagen ?>" />
			<?php else: ?>
				<img src="<?= base_url ?>assets/img/camiseta.png" />
			<?php endif; ?>
		</div>
		<div class="data">
			<p class="description"><?= $product->descripcion ?></p>

			<?php if($product->oferta=="no"):?>
				<p class="price"><?= $product->precio ?>$</p>
			<?php else:?>
				<p class="price">precio anterior <del><?=Utils::getBargain($product->precio)?></del>€</p>
				<p class="price">precio rebajado <?=$product->precio?>€</p>
			<?php endif?>



		<?php if ($product->stock > 0): ?>
			<a href="<?=base_url?>carrito/add&id=<?=$product->id?>" class="button">Comprar</a><br><br><br>
		<?php else :?>
			<a href="#" class="button">No disponible</a><br><br><br>
		<?php endif; ?>
		</div>
		<p>Calificacion de nuestros clientes : </p><br>
		<p><?=$review->getProductRating($product->id)?> sobre 10</p><br><br><br>

		<?=$review->printReviewsByProduct($product->id)?>

	</div>
<?php else: ?>
	<h1>El producto no existe</h1>
<?php endif; ?>


