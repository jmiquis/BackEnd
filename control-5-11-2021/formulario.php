<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
   <form action="index.php" method="get">
        <p>ha ganado <?=$partidasGanadas?> partidas</p>
        <p><?=$palabraConGuiones?></p>
        <p>has cometido <?=$_SESSION["fallos"]?> fallos</p>
        <p>introduzca una letra <input type="text" name="letraUsuario"></p>
   </form>

</body>
</html>