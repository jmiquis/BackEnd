<h1>Algunos de nuestros productos</h1>

<?php while($product = $productos->fetch_object()): ?>
	<div class="product">
		<a href="<?=base_url?>producto/ver&id=<?=$product->id?>">
			<?php if($product->imagen != null): ?>
				<img src="<?=base_url?>uploads/images/<?=$product->imagen?>" />
			<?php else: ?>
				<img src="<?=base_url?>assets/img/camiseta.png" />
			<?php endif; ?>
			<h2><?=$product->nombre?></h2>
		</a>
		<p><?=$product->precio?></p>
		<?php if ($product->stock > 0): ?>
			<a href="<?=base_url?>carrito/add&id=<?=$product->id?>" class="button">Comprar</a>
		<?php else :?>
			<a href="#" class="button">No disponible</a>
		<?php endif; ?>

	</div>
<?php endwhile; ?>