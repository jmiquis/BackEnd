<h1>Registrarse</h1>

<?php if(isset($_SESSION['register']) && $_SESSION['register'] == 'complete'): ?>
	<strong class="alert_green">Registro completado correctamente</strong>
<?php elseif(isset($_SESSION['register']) && $_SESSION['register'] == 'failed'): ?>
	<strong class="alert_red">Registro fallido, introduce bien los datos</strong>
<?php endif; ?>
<?php Utils::deleteSession('register'); ?>

<form action="<?=base_url?>usuario/save" method="POST">
	<label for="nombre">Nombre</label>
	<input type="text" name="nombre" required/>

	<label for="apellidos">Apellidos</label>
	<input type="text" name="apellidos" required/>

	<label for="email">Email</label>
	<input type="email" name="email" required/>

	<label for="password">Contraseña</label>
	<input type="password" name="password" required/>

	introduzca una dirección por defecto para enviarle sus pedidos: <br>

	direccion:
	<input type="text" name="defaultAdress" required>
	localidad
	<input type="text" name="defaultRegion" required>
	provinvcia
	<input type="text" name="defaultArea" required>

	<input type="submit" value="Registrarse" />
</form>