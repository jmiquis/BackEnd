<!-- . Realizar el programa perfil.php que haciendo uso de cookies guarde en el navegador  la edad, sexo y deportes preferidos de un usuario durante una semana. El programa mostrará los valores almacenados mediante un formulario para que el usuario pueda modificarlos o borrarlos.  Si no existen los cookies se mostrará los campos en blanco. -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <form action="perfil.php" method="get">
        <p>edad: <input type="number" name="edad" id=""></p>
        <p>genero:  <input type="radio" name="genero" value="masculino"> <input type="radio" name="genero" value="femenino"></p>
        <p>deportes:</p>
        <select name="deportes[]" id="" multiple>
            <option value="futbol">futbol</option>
            <option value="baloncesto">basket</option>
            <option value="tenis">tenis</option>
            <option value="ping pong">ping pong</option>
        </select>
        <p><input type="submit" name="orden" value="almacenar datos">
            <input type="submit" name="orden" value="borrar datos"></p>
    </form>
</head>
<body>

</body>
</html>