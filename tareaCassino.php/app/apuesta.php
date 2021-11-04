
    <form name="apuesta" action="index.php" method="POST">
    <p>dispone de <?=$_SESSION["dinero"]?> para jugar</p>
    <p>
        cantidad a apostar
        <input type="number" name="apuesta" id="" >
    </p>
    <p>tipo de apuesta</p>
    <p>
        par <input type="radio" name="parImpar" value="par">
        impar <input type="radio" name="parImpar" value="impar">
    </p>
    <p>
        <input type="submit" name="orden" value="hacer apuesta">
        <input type="submit" name="orden" value="dejar el casino">
    </p>
    <p><?=(isset($_SESSION["mensaje"]))?$_SESSION["mensaje"]:"";?></p>
    </form>

