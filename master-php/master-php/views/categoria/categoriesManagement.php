<h1>gestion de categoria <?=$category->getNombre()?></h1>

<p><?=(isset($_SESSION['category_change']))? $_SESSION['category_change'] : '' ?></p><br><br>
<?php

Utils::deleteSession('category_change'); ?>


<form action="<?=base_url?>categoria/modifyCategory" method="POST">
    <input type="hidden" name="id" value="<?=$category->getId()?>">
     nombre de categoria <input type="text" name="categoryName" value="<?=$category->getNombre()?>">
     <input type="submit" name="modify" value="modificar nombre"><br>
</form>

     <?php if(!in_array($category->getId(),Utils::getCategoriesWithProducts())):?>
         <form action="<?=base_url?>categoria/deleteCategory" method="POST">
            <input type="hidden" name="id" value="<?=$category->getId()?>">
            <input type="button"  name="modify" value="eliminar categoria" onclick="confirmDeleteCategory('<?=$category->getNombre()?>')">
         </form>
     <?php else:?>
         <p>esta categoria contiene productos y no puede ser borrada</p><br><br>
         <p>Valor generado por esta categoría          : <?=$category->getTotalSold()." €"?></p><br>
         <p>Valor acumulado en stock de esta categoría : <?=$category->getStockValue()." €"?></p>
     <?php endif?>
     <br><br>



     <button><a href="<?=base_url?>categoria/index">volver</button>


