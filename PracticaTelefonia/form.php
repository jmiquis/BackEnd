<?php
       require_once ("database.php");

       $dbh;
        try {
            $dsn = "mysql:host=localhost:3308;dbname=telefonia;charset=utf8";
            $dbh = new PDO($dsn, "root", "root");
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e){
            echo "Error de conexión ".$e->getMessage();
            exit();
        }

       function getUsers(PDO $dbh){
        if(isset($_GET['puntos'])) $numero=$_GET['puntos'];
         $prepare="SELECT * FROM clientes WHERE puntos<=:limite";
         $result=$dbh->prepare($prepare);
         $result->bindParam(":limite",$numero);
         $result->execute();
         $retorno=$result->fetchAll(PDO::FETCH_ASSOC);
         return $retorno;
       }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="form.php" method="get">
        indique numero de puntos <input type="number" name="puntos">
        <input type="submit" name="accion">
    </form>
    <div>
       <?php if(isset($_GET['accion'])):?>
       <?php foreach(getUsers($dbh) as $key=>$value):?>
           <?php foreach($value as $clave=>$campo):?>
                <?=$clave."  ".$campo?><br>
           <?php endforeach?>
       <?php endforeach?>
       <?php endif?>
    </div>
    <table>

    </table>


</body>


</html>

