



este es su carrito:

<?php if(isset($_SESSION["frutas"])):?>
<table>
    <?php foreach ($_SESSION["frutas"] as $key => $value):?>
        <tr>
            <td><?=$key?></td>
            <td><?=$value?></td>
        </tr>
    <?php endforeach?>
</table>
<?php endif?>