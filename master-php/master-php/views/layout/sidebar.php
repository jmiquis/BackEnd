<!-- BARRA LATERAL -->

		<aside id="lateral">

			<div id="carrito" class="block_aside">
				<h3>Mi carrito</h3>
				<ul>
					<?php $stats = Utils::statsCarrito(); ?>
					<li><a href="<?=base_url?>carrito/index">Productos (<?=$stats['count']?>)</a></li>
					<li><a href="<?=base_url?>carrito/index">Total: <?=$stats['total']?> $</a></li>
					<li><a href="<?=base_url?>carrito/index">Ver el carrito</a></li>
				</ul>
			</div>

			<div id="login" class="block_aside">

				<?php if(!isset($_SESSION['identity'])): ?>

					<h3>Entrar a la web</h3>

					<strong class="alert_red"><p><?=Utils::showsLoginErrorMsg()?></p></strong>

					<form action="<?=base_url?>usuario/login" method="post" class="was-validated">

					<!-- email -->
					<div class="mb-3">
    				<label for="email" class="form-label">Email</label>
    					<input type="email" name="email" class="form-control is-invalid" id="email" placeholder="es necesario introducir un email valido" required></input>
  					</div>
					<!-- contraseña -->
					  <label for="password" class="form-label">Contraseña</label>
    					<input type="password" name="password" class="form-control is-invalid" id="password" placeholder="es necesario introducir una contraseña valida" required></input>
  					</div>
					  <!-- boton -->
					  <input type = "submit" value="Enviar" />
					</form>

				<?php else: ?>
					<h3><?=$_SESSION['identity']->nombre?> <?=$_SESSION['identity']->apellidos?></h3>

				<?php endif; ?>
					<!-- acciones si admin -->
				<ul>
					<?php if(isset($_SESSION['admin'])): ?>
						<li><a href="<?=base_url?>categoria/index"> Gestionar categorias</a></li>
						<li><a href="<?=base_url?>producto/gestion&pagina=1">Gestionar productos</a></li>
						<li><a href="<?=base_url?>pedido/gestion">  Gestionar pedidos</a></li>
						<li><a href="<?=base_url?>usuario/gestion"> Gestionar usuarios</a></li>
					<?php endif; ?>
					<!-- acciones si usuario -->
					<?php if(isset($_SESSION['identity'])): ?>
						<li><a href="<?=base_url?>pedido/mis_pedidos">Mis pedidos</a></li>
						<li><a href="<?=base_url?>usuario/logout">Cerrar sesión</a></li>
						<li><a href="<?=base_url?>usuario/gestion"> Gestionar datos usuario</a></li>
					<?php else: ?>
						<li><a href="<?=base_url?>usuario/registro">Registrate aqui</a></li>
					<?php endif; ?>
				</ul>
			</div>

		</aside>

<!-- CONTENIDO CENTRAL -->
<div id="central">