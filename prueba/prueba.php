<?php

// $num = 3;


// $result = match ($num) {
//     4   =>  "here we are",
//     3   =>  "yes, it works",
//     2   =>  "really?"
// };


// echo ($result);


// function test($num){

//     return ($num >= 3) ? " todo ok" : " c'est pas bien";

// }

// echo (test($num));


// $arrayEjemplo=[
//     0 => ["peso"=>33,"altura"=>177],
//     1 => ["peso"=>87,"altura"=>187]
// ];
// $arrayResultado=[];

// $arrayResultado=array_map((fn($objeto)=>$objeto["altura"]),$arrayEjemplo);

// var_dump($arrayEjemplo);



// class alumno{

//     static int $numeroAluno=0;

//     public function __construct(
//         $edad,
//         $nombre,
//         $dinero
//         ) {
//         $this->edad=$edad;
//         $this->nombre=$nombre;
//         $this->dinero=$dinero;
//         $this->id=self::$numeroAluno;

//         alumno::$numeroAluno++;
//     }

//     function __get($name){
//         return $this->$name;
//     }
// }



// $clase=[
// $jorge =  new Alumno(34,"Miquis",1),
// $luis  =  new Alumno(33,"Pérez",4),
// $maria =  new Alumno(32,"Sánchez",3)
// ];

// usort($clase,fn($alumno1,$alumno2)=>$alumno2->dinero-$alumno1->dinero);

// if (!is_writable("texto.txt")){ //si el archivo ni existe ni se tienen permisos de escritura
//     die("error al intentar abrir el archivo de datos");
// }
// else{
// //borro el archivo de texto para evitar duplicacion de datos
// file_put_contents("texto.txt","");

// //para cada array con los datos de un usuario en SESSION le pone una linea al txt
// foreach ($arrayEjemplo as $key => $value) {

//         file_put_contents("texto.txt",implode("|",$value)."\n",FILE_APPEND);
// }

// } -->

// $connection=new mysqli("127.0.0.1:3308","root","root","empresa") or die("error al intentar abrir la base de datos");

// $query="SELECT * FROM productos";

$pass = "secreto";
$encPass = password_hash($pass,PASSWORD_BCRYPT,['cost' => 4]);

$verify = password_verify($pass,$encPass);

echo($maria());


