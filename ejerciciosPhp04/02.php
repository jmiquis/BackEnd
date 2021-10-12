<!-- Crear página que simule un calculadora sencilla, mediante un único archivo 02.php que mostrará un formularios con dos campos numéricos y 4 botones con los 4 tipos de operaciones + - * /  posibles. Se incluirá también 3 controles de tipo radio que indicarán como queremos que se muestre el resultado en decimal, binario o hexadecimal.
El programa php debe comprobar que se han recibido los dos valores numéricos y detectará el error de intento de división por cero. Mostrará el resultado calculado según el formato elegido. Por omisión se mostrará en decimal -->
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
if(isset($_POST["botones"])){
            $operando1=$_POST["operando1"];
            $operando2=$_POST["operando2"];
            $operacion=$_POST["botones"];
            $resultado=0;

         function oper($operando1,$operando2,$operacion){
            switch ($operacion) {
                case '+':
                    $resultado=$operando1+$operando2;
                    break;
                case '-':
                    $resultado=$operando1-$operando2;
                    break;
                case 'x':
                    $resultado=$operando1*$operando2;
                    break;
                case '/':
                    $resultado=$operando1/$operando2;
                    break;
            }
            return salida($resultado);
        }
        function salida($resultado){
           switch ($_POST["salidaResultado"]) {
               case "decimal":
                return $resultado;
               case 'binario':
                   return decbin($resultado);
               case 'hexa':
                return dechex($resultado);
           }
        }

    }

    ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .botones{
            display: flex;
            margin: auto;
        }
    </style>
</head>
<body>
    <form action="02.php" method="POST">
        operando 1:<p><input type="text" name="operando1" size="5" value="<?=(isset($_POST["botones"]))?$operando1:''?>"></p>
        operando 2:<p><input type="text" name="operando2" size="5" value="<?=(isset($_POST["botones"]))?$operando2:''?>"></p></p>
        <input type="submit" name="botones" value="+">
        <input type="submit" name="botones" value="-">
        <input type="submit" name="botones" value="x">
        <input type="submit" name="botones" value="/">
        <br>
        decimal:<input type="radio" name="salidaResultado" value="decimal" checked>
        binario:<input type="radio" name="salidaResultado" value="binario">
        hexadecimal:<input type="radio" name="salidaResultado" value="hexa">

    </form>
    <textarea name="salida" id="salida" cols="30" rows="10" ><?=(isset($_POST["botones"]))?"$operacion >>>> ".oper($operando1,$operando2,$operacion)." $_POST[salidaResultado]":""?></textarea>
</body>
</html>