<!-- Obtener un número al azar entre 1 y 9 y generar una la escalera numérica del tamaño indicado alternando colores entre rojo y azul. -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $var1=random_int(1,9);

        for($i=0;$i<$var1;$i++){
            for($j=0;$j<$i;$j++){
                if($i%2==0){
                    echo("<span style='color: red'>$i</span>");
                }
                else{
                    echo("<span style='color: blue'>$i</span>");
                }
            }
            echo("<br>");
        }

    ?>
</body>
</html>
