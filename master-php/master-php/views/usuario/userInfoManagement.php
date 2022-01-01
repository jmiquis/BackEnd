<h1>Usuario <?=$user->getNombre()?></h1>
<!-- visualiza o modifica los datos del usuario -->

<?php if(isset($_SESSION['modified']) && $_SESSION['modified']=="succesful"):?>
    <strong class="alert_green">Cambio realizado por completo</strong>
<?php elseif(isset($_SESSION['modified']) && $_SESSION['modified']=="unsuccesful"):?>
    <strong class="alert_red">Cambio fallido, introduce bien los datos</strong>
<?php endif ?>
<?php Utils::deleteSession('modified'); ?>


<form action="<?=base_url?>usuario/modifyUser" method="POST" enctype="multipart/form-data">
    <p>ID        <input type="text" name="id"        value = "<?=$user->getId();?>" readonly> </p>
    <p>NOMBRE    <input type="text" name="nombre"    value = "<?=$user->getNombre();?>">      </p>
    <p>APELLIDOS <input type="text" name="apellidos" value = "<?=$user->getApellidos();?>">   </p>
    <p>EMAIL     <input type="text" name="email"     value = "<?=$user->getEmail();?>">       </p>


    <!-- select desplegable para elegir roles entre los disponibles si el usuario es admin -->
    <?php if (isset($_SESSION['admin'])):?>
    ROL :
        <select name="rol" id="">

            <?php for ($i = 0 ; $i < count( $rolesArray ) ; $i++  ):?>
                                                            <!-- selecciona el rol por defecto y lo muestra -->
                    <option value="<?=$rolesArray[$i]?>" <?=($user->getRol()==$rolesArray[$i]) ? "selected" : ""?>><?=$rolesArray[$i]?></option>

            <?php endfor ?>

        </select>

    <?php endif?>

    <!-- muestra la imagen en funcion de si existe o no el parametro -->

	<img src="<?= base_url ?>uploads/images/<?= $user->getImagen()?>"name="imagenUser" style="width: 14rem;" />


    seleccionar imagen:
    <input name="imagen" type="file"/><br><br><br><br>

    <input type="submit" value="aceptar cambios datos usuario"  name="orden" class ="button button-gestion">
</form>


        <!-- eliminar usuario con confirmacion javascript . No aparece si el usuario tiene pedidos abiertos-->
    <?php if(isset($_SESSION['admin'])):?>
        <?php if(!(in_array($user->getId(),$usuariosConPedidos))):?>
    <!-- crea un formulario por cada boton para eliminar -->

    <form action="<?=base_url?>usuario/deleteUser" method="POST">
        <input type="hidden" name="deleteId" value="<?=$user->getId()?>">
        <input type="button"  name="accion" value="eliminar usuario" onclick="confirmDeleteUsers('<?=$user->getNombre()?>')">
    </form>
        <?php else :?>
            <p>este usuario no puede ser borrado por tener pedidos abiertos</p>
        <?php endif?>
    <?php endif?>


    <button><a href="<?=base_url?>usuario/gestion"> volver </a></button>
