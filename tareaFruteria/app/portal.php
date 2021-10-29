
<form name="portal" method="POST" action="index.php">
        <h3><?="realice su compra ".$_SESSION["nombre"]?></h3>
        <p>SELECCIONE SU FRUTA:
            <select name="frutas" id="">
                <option value="platano">platano</option>
                <option value="naranja">naranjas</option>
                <option value="limon">limon</option>
                <option value="manzana">manzana</option>
            </select>
            cantidad: <input type="number" name="cantidad">
            <input type="submit" name="orden"  value="anotar" id="">
            <input type="submit" name="orden" value="terminar">
        </p>
</form>
