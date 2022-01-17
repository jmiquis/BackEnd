<h1>gestion de categoria <?=$category->getNombre()?></h1>

<p><?=(isset($_SESSION['category_change']))? $_SESSION['category_change'] : '' ?></p><br><br>
<?php

Utils::deleteSession('category_change'); ?>


<form action="<?=base_url?>categoria/modifyCategory" method="POST">
    <input type="hidden" name="id" value="<?=$category->getId()?>">
     nombre de categoria <input type="text" name="categoryName" value="<?=$category->getNombre()?>">
     <input type="submit" name="modify" value="modificar nombre"><br>
</form>
     <br><br>



     <button><a href="<?=base_url?>categoria/index">volver</button>


