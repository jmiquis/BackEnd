<p><?=(isset($_SESSION['adress_change']))? $_SESSION['adress_change'] : '' ?></p><br><br>
<?php Utils::deleteSession('adress_change'); ?>

    <form action="<?=base_url?>usuario/changeAdress" method="post">
    Cambiar direccion por defecto:<br>
    <input type="hidden" name="id" value="<?=$usuario->getId()?>">
    direccion:<input type="text" name="defaultAdress" value="<?=$userAdress->direccion?>">
    localidad:<input type="text" name="defaultArea"   value="<?=$userAdress->localidad?>">
    provincia:<input type="text" name="defaultRegion" value="<?=$userAdress->provincia?>">

    <input type="submit" name="changeAdress" value="cambiar direccion">
    </form>

    <button><a href="<?=base_url?>usuario/gestion"> volver </a></button>