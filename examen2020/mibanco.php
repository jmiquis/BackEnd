<?php
session_start();
if (!isset($_SESSION["saldo"])){
    $_SESSION["saldo"]=0;
}


?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>MiniBank</title>
</head>
<body>
<?php
if (!empty($_GET['msg'])) echo "RESULTADO:". $_GET['msg']."<br>";
?>
<form action="mibancopro.php" method="POST">
Importe de la operación: <input name="importe" type="text" focus><br>
<input type="submit" name="Orden" value="Ingreso">
<input type="submit" name="Orden" value="Reintegro">
<input type="submit" name="Orden" value="Ver saldo">
<input type="submit" name="Orden" value="Terminar">
</form>
</body>
</html>