<!-- Realizar el script vermes.php que muestre un formulario en el que el usuario pueda  introducir  un mes y un año, y muestre el calendario  correspondiente a ese mes según el formato de figura.  El formulario tendrá de dos campos select donde el usuario podrá seleccionar el nombre de los meses y  los años desde 1980 al año actual (generar el año actual de forma automática) -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body{
            font-size: 30px;
        }
        table,tr,td,th{
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
    <title>Document</title>
</head>
<body>
    <?php if($_SERVER["REQUEST_METHOD"]=="GET"):?>
    <h1>Bienvenido al generador de calendarios</h1>
    <form action="03.php" method="post">
        <!-- desplegable de meses -->
        <select name="mes" id="">
            <option value="1">enero</option>
            <option value="2">febrero</option>
            <option value="3">marzo</option>
            <option value="4">abril</option>
            <option value="5">mayo</option>
            <option value="6">junio</option>
            <option value="7">julio</option>
            <option value="8">agosto</option>
            <option value="9">septiembre</option>
            <option value="10">octubre</option>
            <option value="11">noviembre</option>
            <option value="12">diciembre</option>
        </select>

       <!-- desplegable de años -->
       <p><select name="year" id="" value="<?=(isset($_POST['year'])?$_POST['year']:'')?>">
            <?php for($i=1980;$i<=date("Y");$i++):?>
                <option value="<?=$i?>"><?=$i?></option>
            <?php endfor?>
          </select>
        </p>
        <p><input type="submit" value="generar calendario"></p>
    </form>

<?php else:?>
    <?php
    //variables
    define("ARRAYMESES",["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"]);
    $arrayCalendario=[];
    $fecha="";
    //funciones

     //genera un array inicializado a " "
     function iniciaArraySemanas(){
        $array=[];
        $arrayDiasSemana=[];
         for ($i=0; $i <5 ; $i++) {
          $array[$i]=array_fill(0,6," ");
         }
         return $array;
    }
    //se dan valores a los elementos del array
    function generaArraySemanas($fecha){
       $segundosFecha=strtotime($fecha);// se pasa a segundos la fecha
       $finDeMes=date('t',$segundosFecha);
       $arrayCalendario=iniciaArraySemanas();
       $semana=0;


       for ($i=1; $i <=$finDeMes ; $i++) {//recorre los dias del mes
            $fechaResul=$_POST["mes"]."/".$i."/".$_POST["year"];
            $segundosFechaResul=(strtotime($fechaResul));//pasa a segundos

            $diaSemana=date("N",$segundosFechaResul)-1;

            $arrayCalendario[$semana][$diaSemana]=$i;

            $semana=($diaSemana==6)?$semana+1:$semana;



       }
       return $arrayCalendario;
    }


    //ejecucion
    $fecha=$_POST["mes"]."/01/".$_POST["year"];//formato por defecto mes/dia/año
    $arrayCalendario=generaArraySemanas($fecha);

    ?>
<hr>
    <table>
        <h1><?= ARRAYMESES[$_POST["mes"]-1]." de ".$_POST["year"] ?></h1>
        <tr>
            <th>L<th>M</th><th>X</th><th>J</th><th>V<th>S</th><th style="color: red;">D</th>
        </tr>
        <?php for ($i=0; $i <count($arrayCalendario) ; $i++):?>
            <tr>
                <?php for($j=0;$j<count($arrayCalendario[$i]);$j++):?>
                    <td style="color: <?=($j==6)?'red':'blue' ?>">
                        <?=$arrayCalendario[$i][$j] ?>
                    </td>
                <?php endfor?>
            </tr>
        <?php endfor ?>
    </table>


<?php endif ?>
</body>
</html>