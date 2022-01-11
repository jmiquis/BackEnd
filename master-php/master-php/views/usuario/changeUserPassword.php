
<h3>Usuario <?=$usuario -> getNombre()?></h3>

<p><?=(isset($_SESSION['password_change']))? $_SESSION['password_change'] : '' ?></p><br><br>
<?php Utils::deleteSession('password_change'); ?>

<form action="<?=base_url?>usuario/modifyPassword" method="POST">
<p>Cambio de contraseña:</p><br><br>
    id usuario        : <input type="text"     name="id" readonly value="<?=$usuario->getId()?>">
    Contraseña actual : <input type="password" name="oldPass">
    Nueva contraseña  : <input type="password" name="newPass">
    Repita contraseña : <input type="password" name="newPassRepeat">

    <input type="submit" name="validar" value="validar">
</form>

<button><a href="<?=base_url?>usuario/gestion"> volver </a></button>