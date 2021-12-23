<?php session_start()?>


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

function loginOk($nombre, $numeroIntentos){

    echo("Hola $nombre, esta es su visita numero $numeroIntentos");

}

// EJEMPLO DE CONEXIÓN A LA BASE DE DATOS
// Utilizando el interfaz PDO
    if ( isset($_SESSION['usuarioConAcceso']) &&  $_SERVER['REQUEST_METHOD'] == "GET") {
        loginOk($_SESSION['usuarioConAcceso'],$_SESSION["accesos"]);
?>
    <form method = "POST" >
        <input type="submit" name="orden" value="Salir">
    </form>
</div>
</body>
</html>
    <?php
    exit();
}



if ( $_SERVER['REQUEST_METHOD'] == "POST"){

    try {
        $dsn = "mysql:host=127.0.0.1:3308;dbname=Prueba";
        $dbh = new PDO($dsn, "root", "root");
        // $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e){
        echo "Error de conexión ".$e->getMessage();
        exit();
    }


    // Filtro escapa caracteres peligrosos
    $login  = ($_POST['login']);
    $passwd = ($_POST['passwd']);



    // Sentencia preparada
    $stmt = $dbh->prepare("SELECT * FROM Usuario WHERE login = ? and passwd = ?");
    //se da valores a las interrogantes de la consulta preparada
    $stmt->bindValue(1,$login);
    $stmt->bindValue(2,$passwd);
    // Devuelvo una tabla asociativa
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    if ( $stmt->execute() ){
        if ( $fila = $stmt->fetch()) {
            //si la password correspone al usuario
            if($passwd===$fila["passwd"]){
            loginOk($fila["Nombre"], $fila["accesos"]);
            //agrega el nombre del usuario a la variable session
            $_SESSION["usuarioConAcceso"]=$fila["login"];
            //suma el acceso actual
            $fila['accesos']++;
            //actualiza los accesos del usuario a la variable session
            $_SESSION["accesos"]=$fila['accesos'];
            //actualiza los accesos en la base de datos
            $consulta = "UPDATE Usuario SET accesos = $fila[accesos] where login ='$_POST[login]'";
            // Consulta directa
            if ($dbh->exec($consulta) == 0){
                echo " ERROR UPDATE en la BD ".print_r($dbh->errorInfo())."<br>";
            }
            die();
        }
        else {
            echo "El identificador y/o la contraseña no son correctos.<br>";
        }
    }else {
        echo "El identificador y/o la contraseña no son correctos.<br>";
    }
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