
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

?>
