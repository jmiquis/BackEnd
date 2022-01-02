
<h1>Gestión de usuarios</h1><br><br>

<p><?=(isset($_SESSION["UserManagementMsg"])) ? $_SESSION["UserManagementMsg"] : ""; ?></p><br><br><br>
<?php Utils::deleteSession("UserManagementMsg");?>

<?php if(isset($_SESSION['admin'])):?>
    <button><a href="<?=base_url?>usuario/registro">crear usuario</a></button>
<?php endif?>


<?php if (isset($usuarios)):?>

        <table>
            <tr><th>Nombre de usuario</th><th>Apellidos</th><th>Rol</th><th>email</th><th>imagen</th></tr>
        <?php foreach ($usuarios as $key => $user):?>
            <tr>
                <td>
                    <?=$user -> getNombre()   ?>
                </td>
                <td>
                    <?=$user -> getApellidos()?>
                </td>
                <td>
                    <?=$user -> getRol()      ?>
                </td>
                <td>
                    <?=$user -> getEmail()    ?>
                </td>
                <td>
                    <img src="<?=base_url?>uploads/images/<?= $user->getImagen()?>" name="imagenUser" alt="<?= $user->getImagen()?>" id="imagenUsuarioMIni">
                </td>
                <td>
                    <!-- cambio de contraseña-->
                <?php if (isset($_SESSION['admin']) || Utils::checksNonAdminId($user->getId())):?>
                        <a href="<?=base_url?>usuario/changeUserPassword&id=<?=$user->getId()?>" class ="button button-gestion">cambiar contraseña</a>
                <?php endif?>
                </td>
                <td>
                    <!-- HREF / lleva a otra pagina -->
                <a href="<?=base_url?>usuario/userInfoManagement&id=<?=$user->getId()?>" class ="button button-gestion">gestion datos personales</a>
                </td>
                <td>
                    <!-- HREF / lleva a otra pagina -->
                <a href="<?=base_url?>usuario/modifyAdress&id=<?=$user->getId()?>" class ="button button-gestion">cambiar direccion por defecto</a>
                </td>
                <td>
                    <?php if (in_array($user->getId(),Utils::checkFreeOrdersUser())):?>
                        <a href="<?=base_url?>usuario/userOrdersManagement&id=<?=$user->getId()?>" class ="button button-gestion">gestion pedidos</a>
                    <?php else:?>
                        <p>usuario sin pedidos</p>
                    <?php endif?>
                </td>
            </tr>
        <?php endforeach?>
        </table>

<?php endif?>