<h1>Editar producto <?=$pro->getNombre()?></h1>

<p><?=(isset($_SESSION['product_change']))? $_SESSION['product_change'] : '' ?></p><br><br>
<?php Utils::deleteSession('product_change'); ?>

<form action="<?=base_url?>producto/modifyProduct" method="post">

    <input type="hidden" name="id" value="<?=$pro->getId()?>">
    <p>nombre producto</p>
    <input type="text" name="productName" value="<?=$pro->getNombre()?>">
    <p>categoria</p>
    <select name="category">
        <?php foreach($cat->getAll() as $clave=>$categoria):?>
            <option value="<?=$categoria['id']?>"<?=($categoria['id']==$pro->getCategoria_id())? "selected":""?>><?=$categoria['nombre']?></option>
        <?php endforeach?>
    </select>
    <p>precio de unidad</p>
    <input type="number" name="cost" value="<?=$pro->getPrecio()?>">
    <p>stock actual</p>
    <input type="number" name="stock" value="<?=$pro->getStock()?>">
    <p>producto en oferta</p>
    <select name="deal" >
        <option value="si" <?=($pro->getOferta()=="si")?"selected":""?>>si</option>
        <option value="no" <?=($pro->getOferta())=="no"?"selected":""?>>no</option>
    </select>

    <img src="<?= base_url?>uploads/images/<?=$pro->getImagen()?>" alt="imagen producto" style="width: 10rem;">

    seleccionar imagen:
    <input name="image" type="file"/><br><br><br><br>

    <p>descripcion</p>
    <input type="text" name="description" value="<?=$pro->getDescripcion()?>">

    <input type="submit" value="aceptar cambios datos producto"  name="orden" class ="button button-gestion">
</form>

</form>



