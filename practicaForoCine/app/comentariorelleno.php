<form name='mensaje' method="POST">
Tema<br>
 <input type="text" name="tema" size=30
   value="<?=(isset($_REQUEST['tema']))?noInyeccionHTML($_REQUEST['tema']):''?>" ><br>
Comentario: <br>
<textarea name="comentario" rows="4" cols="50"><?=(isset($_REQUEST['comentario']))?noInyeccionHTML($_REQUEST['comentario']):''?></textarea>
<br><br>
<input type="submit" name="orden" value="Detalles">
<input type="submit" name="orden" value="Nueva opinión">
<input type="submit" name="orden" value="Terminar">
<p><input type="submit" name="orden" value="traducir"></p>
traducir comentario al :  <select name="idioma" id="">
  <option value="en" default>ingles</option>
  <option value="fr">frances</option>
  <option value="it">italiano</option>
  <option value="pt">portugues</option>
  <option value="sv">sueco</option>
  <option value="zh">chino</option>
</select>

</form>
