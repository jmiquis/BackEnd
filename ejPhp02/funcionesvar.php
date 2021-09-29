
<?php
//ejercicio 1
        $a=random_int(1,100);
        $b=random_int(1,100);
        $c=random_int(1,100);

     function elMayor($a,$b,&$c){
        if ($a>$b && $a>$c) {
            $c=$a;
        }
        elseif ($b>$a && $b>$c) {
            $c=$b;
        }
        elseif ($a==$b) {
            $c=0;
        }
        return $c;
    }

//ejercicio 2
        function suma($oper1,$oper2){
                $resul=$oper1+$oper2;
                echo("La suma de $oper1 y $oper2 = $resul <br>");
        }
        function resta($oper1,$oper2){
            $resul=$oper1+$oper2;
            echo("La resta de $oper1 y $oper2 = $resul <br>");
        }
        function multi($oper1,$oper2){
            $resul=$oper1+$oper2;
            echo("El producto de $oper1 y $oper2 = $resul <br>");
        } function division($oper1,$oper2){
            $resul=$oper1+$oper2;
            echo("El cociente de $oper1 y $oper2 = $resul <br>");
        }
        function potencia($oper1,$oper2){
            $resul=$oper1+$oper2;
            echo("La potencia de $oper1 y $oper2 = $resul <br>");
        }


        //ejercicio 4
        define("TOTAL",50);
        define("LIMITE",100);
        $numero4=0;
        $mayor=0;
        $menor=101;
        $suma=0;
        $arrayNumeros;
        $arrayNombres=[0=>"minimo",1=>"maximo",2=>"media"];

        for ($i=0; $i < TOTAL; $i++) {
            $numero4=random_int(1,LIMITE);
            $suma+=$numero4;

            $mayor=($numero4>$mayor)?$numero4:$mayor;
            $menor=($numero4<$menor)?$numero4:$menor;
        }
            $media=$suma/TOTAL;
            $arrayNumeros=[0=>$menor,1=>$mayor,2=>$media];

            //ejercicio 5
            function generarHTMLTable ( $filas, $columnas, $borde,$contenido){
                echo("<table border='$borde'>");
                for ($i=0; $i <$filas ; $i++) {
                    echo("<tr border='$borde'>");
                    for ($j=0; $j < $columnas ; $j++) {
                        echo("<td border='$borde'> $contenido </td>");
                    }
                    echo("</tr>");
                }
                echo("</table>");
            }

            //ejercicio 6
            function pintaAlmenas($numeroAlmenas){

                for ($i=0; $i < 3; $i++) {
                   for ($j=0;$j <$numeroAlmenas; $j++){
                        if ($i!=2) {
                            echo("****&nbsp;");
                        }
                        else{
                            echo("*****");
                        }
                   }
                   echo("<br>");
                }
            }
            //7.1

            function construyeTabla(){
                for ($i=0; $i <10 ; $i++) {
                    echo("<tr>");
                   for ($j=0; $j < 10; $j++) {
                       $color=generaColor1();
                        echo("
                        <td style='background-color:$color'></td>
                        ");
                   }
                   echo("</tr>");
                }

            }

           function generaColor1(){
                $numeroColor=random_int(1,5);
                switch ($numeroColor) {
                    case 1:
                       return "red";
                    case 2:
                       return "blue";
                    case 3:
                       return "green";
                    case 4:
                       return "red";
                    case 5:
                       return "white";
                }
            }
            function generaColor2(){
            return $rcolor = "rgb(" . random_int(0, 255) . "," . random_int(0, 255) . "," . random_int(0, 255) . ")";
            }

?>
