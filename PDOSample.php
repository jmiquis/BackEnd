
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link href="default.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="container" style="width: 400px;">
<div id="header">
<h1>ACCESO AL SISTEMA</h1>
</div>
<div id="content">

<?php
// EJEMPLO DE CONEXIÓN A LA BASE DE DATOS
// Utilizando el interfaz PDO

if ( $_SERVER['REQUEST_METHOD'] == "POST"){

    try {
        $dsn = "mysql:host=192.168.1.42;dbname=Pruebas";
        $dbh = new PDO($dsn, "root", "root");
        // $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e){
        echo "Error de conexión ".$e->getMessage();
        exit();
    }


    // Filtro escapa caracteres peligrosos
    $login=   $dbh->quote($_POST['login']);
    $passwd = $dbh->quote($_POST['passwd']);

    // Sentencia preparada
    $stmt = $dbh->prepare("SELECT * FROM Usuario WHERE login = ? and passwd = ?");
    $stmt->bindValue(1,$_POST['login']);
    $stmt->bindValue(2,$_POST['passwd']);
    // Devuelvo una tabla asociativa
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    if ( $stmt->execute() ){
        if ( $fila = $stmt->fetch()) {
            echo " $fila[Nombre]: Bienvenido al sistema <br>";
            echo " Has entrado $fila[accesos] veces <br>";
            $fila['accesos']++;
            $consulta = "UPDATE Usuario SET accesos = $fila[accesos] where login ='$_POST[login]'";
            // Consulta directa
            if ($dbh->exec($consulta) == 0){
                echo " ERROR UPDATE en la BD ".print_r($dbh->errorInfo())."<br>";
            }
        } else {
            echo "El identificador y/o la contraseña no son correctos.<br>";

        }
    } else {
        echo " ERROR de consulta a la BD ".print_r($dbh->errorInfo())."<br>";
    }

}
?>
			<form name='entrada' method="POST" >
				<table  style="border: node; ">
					<tr>
						<td>identificador:</td>
						<td><input type="text" name="login" size="20"></td>
					</tr>
					<tr>
						<td>Contraseña:</td>
						<td><input type="password" name="passwd" size="20"></td>
					</tr>
				</table>
				<input type="submit" name="orden" value="Entrar">
			</form>
		</div>
		<p>
	</div>
</body>
</html>
