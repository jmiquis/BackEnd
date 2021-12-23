<h1>Gestión de usuarios</h1>

<?php if (isset($usuarios)):?>
    <table>
        <tr><th>Nombre de usuario</th><th>Apellidos</th><th>Rol</th><th>email</th><th>imagen</th></tr>
    <?php while ($usuario=$usuarios->fetch_object("Usuario")):?>
        <tr>
            <td>
                <?=$usuario -> getNombre()?>
            </td>
            <td>
                <?=$usuario -> getApellidos()?>
            </td>
            <td>
                <?=$usuario -> getRol()   ?>
            </td>
            <td>
                <?=$usuario -> getEmail()   ?>
            </td>
            <td>
                <img src="<?=base_url?>uploads/images/<?= $usuario->getImagen()?>" name="imagenUser" alt="<?= $usuario->getImagen()?>" style="width: 3rem;">
            </td>
            <td>
                <!-- botones eliminar y gestionar -->
                <a href="<?=base_url?>usuario/userInfoManagement&id=<?=$usuario->getId()?>" class ="button button-gestion">gestion datos personales</a>
                 <!-- cambio de contraseña -->
                <?php if (isset($_SESSION['admin']) || Utils::checksNonAdminId($user->getId())):?>
                    <a href="<?=base_url?>usuario/changeUserPassword&id=<?=$usuario->getId()?>" class ="button button-gestion">cambiar contraseña</a
                <?php endif?>
                >
				<a href="<?=base_url?>#  <?=$usuario->getId()?>" class="button button-gestion button-red">Eliminar</a>
            </td>
        </tr>
    <?php endwhile?>
    </table>

<?php endif?>