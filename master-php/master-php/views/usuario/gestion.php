
<h1>Gestión de usuarios</h1><br><br>

<p><?=(isset($_SESSION["UserManagementMsg"])) ? $_SESSION["UserManagementMsg"] : ""; ?></p><br><br><br>
<?php Utils::deleteSession("UserManagementMsg");?>

<button><a href="<?=base_url?>usuario/registro">crear usuario</a></button>


 <!-- formulario/ las acciones se mandan al index desde esta misma pagina -->


<?php if (isset($usuarios)):?>

        <table>
            <tr><th>Nombre de usuario</th><th>Apellidos</th><th>Rol</th><th>email</th><th>imagen</th></tr>
        <?php while ($usuario=$usuarios->fetch_object("Usuario")):?>
            <tr>
                <td>
                    <?=$usuario -> getNombre()   ?>
                </td>
                <td>
                    <?=$usuario -> getApellidos()?>
                </td>
                <td>
                    <?=$usuario -> getRol()      ?>
                </td>
                <td>
                    <?=$usuario -> getEmail()    ?>
                </td>
                <td>
                    <img src="<?=base_url?>uploads/images/<?= $usuario->getImagen()?>" name="imagenUser" alt="<?= $usuario->getImagen()?>" style="width: 3rem;">
                </td>
                <td>
                    <!-- cambio de contraseña. Solo aparece si es admin o el propio usuario-->
                <?php if (isset($_SESSION['admin']) || Utils::checksNonAdminId($usuario->getId())):?>
                        <a href="<?=base_url?>usuario/changeUserPassword&id=<?=$usuario->getId()?>" class ="button button-gestion">cambiar contraseña</a>
                <?php endif?>
                </td>
                <td>
                    <!-- HREF / lleva a otra pagina -->
                <a href="<?=base_url?>usuario/userInfoManagement&id=<?=$usuario->getId()?>" class ="button button-gestion">gestion datos personales</a>
                </td>
            </tr>
        <?php endwhile?>

        </table>

<?php endif?>