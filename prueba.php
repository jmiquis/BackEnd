<?php

$array=[
    0=>[1,3,4],
    1=>[1,2,1],
    2=>[3,5,6]
];

$columna=array_column($array,1);

array_multisort($array,SORT_ASC,$columna);

echo "oko";