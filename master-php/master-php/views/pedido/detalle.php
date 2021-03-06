<h1>Detalle del pedido</h1>

<p><?=(isset($_SESSION['change_review']))? $_SESSION['change_review'] : '' ?></p><br><br>
<?php Utils::deleteSession('change_review'); ?>

<?php if (isset($pedido)): ?>
		<?php if(isset($_SESSION['admin'])): ?>
			<h3>Cambiar estado del pedido</h3>
			<form action="<?=base_url?>pedido/estado" method="POST">
				<input type="hidden" value="<?=$pedido->id?>" name="pedido_id"/>
				<select name="estado">
					<option value="confirm"     <?=$pedido->estado == "confirm"     ? 'selected' : '';?>>Pendiente</option>
					<option value="preparation" <?=$pedido->estado == "preparation" ? 'selected' : '';?>>En preparación</option>
					<option value="ready"       <?=$pedido->estado == "ready"       ? 'selected' : '';?>>Preparado para enviar</option>
					<option value="sended"      <?=$pedido->estado == "sended"      ? 'selected' : '';?>>Enviado</option>
				</select>
				<input type="submit" value="Cambiar estado" />
			</form>
			<br/>
		<?php endif; ?>

		<h3>Datos del cliente :</h3>
		<p>Nombre:    <?=$usuario->getNombre()   ?></p>
		<p>Apellidos: <?=$usuario->getApellidos()?></p>
		<p>Email:     <?=$usuario->getEmail()    ?></p>
		<br> <br>

		<h3>Dirección de envio</h3>
		Provincia: <?= $pedido->provincia ?>   <br/>
		Cuidad:    <?= $pedido->localidad ?>   <br/>
		Direccion: <?= $pedido->direccion ?>   <br/><br/>

		<h3>Datos del pedido:</h3>
		Estado: <?=Utils::showStatus($pedido->estado)?> <br/>
		Número de pedido: <?= $pedido->id ?>   <br/>
		Total a pagar: <?= $pedido->coste ?> $ <br/>
		Productos:

		<table>
			<tr>
				<th>Imagen</th>
				<th>Nombre</th>
				<th>Precio</th>
				<th>Unidades</th>
			</tr>
			<?php while ($producto = $productos->fetch_object()): ?>
				<tr>
					<td>
						<?php if ($producto->imagen != null): ?>
							<img src="<?= base_url ?>uploads/images/<?= $producto->imagen ?>" class="img_carrito" />
						<?php else: ?>
							<img src="<?= base_url ?>assets/img/camiseta.png" class="img_carrito" />
						<?php endif; ?>
					</td>
					<td>
						<a href="<?= base_url ?>producto/ver&id=<?= $producto->id ?>"><?= $producto->nombre ?></a>
					</td>
					<td>
						<?= $producto->precio ?>
					</td>
					<td>
						<?= $producto->unidades ?>
					</td>
				</tr>

				<?php $review->id_producto=$producto->id?>

				<!-- si el usuario tiene reviews pendientes -->
				<?php if($arrayReviewsPendientes):?>

						<?php if($review->isInArray($arrayReviewsPendientes)):?>
							<form action="<?=base_url?>producto/updateReview" method="POST">
								<input type="hidden" name="productoId" value="<?=$producto->id?>">
								<input type="hidden" name="usuarioId"  value="<?=$pedido->usuario_id?>" >
								<input type="hidden" name="pedidoId"   value="<?=$pedido->id?>">
								<tr>
									<td>Valora el producto</td>
									<td><input type="number" name="notaReview" min=0 max=10></td>
								</tr>
								<tr>
									<td>Comparte tu opinión sobre el producto</td>
								</tr>
								<tr>
									<td><input type="text" name="reviewProducto"></td>
								</tr>
									<td><input type="submit" name="accion" value="enviar review"></td>
							</form>
						<?php endif?>
					<?php endif?>

			<?php endwhile; ?>
		</table>
		<button onclick="window.open('<?= base_url ?>pedido/generatePDF&order=<?=$pedido->id?>','self','width:200')">generar pdf</button>


	<?php endif; ?>