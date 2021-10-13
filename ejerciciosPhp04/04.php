<?php
    //el usuario no puede dejar en blanco porque tienen el atributo required
    $nombre=$_REQUEST["nombre"];
    $password=$_REQUEST["password"];
    $semaforo=(isset($_POST["semaforo"]))?$_POST["semaforo"]:"no hay color de semaforo seleccionado";
    $publicidad=(isset($_POST["publicidad"]))?"El usuario sí quiere publicidad":"El usuario NO quiere publicidad";
    $idioma=generaIdiomas();
    $year=$_POST["finalizacion"];
    $codigosPostales=devulveCodigosPostales();
    $comentario=(isset($_POST["cajaTexto"]))?$_POST["cajaTexto"]:"el usuario no agrega comentarios";

    
    main($nombre,$password,$semaforo,$publicidad,$idioma,$year,$codigosPostales,$comentario);


    function main($nombre,$password,$semaforo,$publicidad,$idioma,$year,$codigosPostales,$comentario){
        echo("
                usuario: $nombre <br>
                password: $password <br>
                color de semaforo: $semaforo <br>
                publicidad: $publicidad <br>
                idiomas: $idioma <br>
                año de finalizazcion: $year <br>
                lista de codigos postales: $codigosPostales <br>
                comentarios: $comentario
            ");
    }





    function generaIdiomas(){
        $idiomas="El usuario no habla ningun idioma";
        if (isset($_POST["idioma"])) {
            $idiomas="El usuario habla: ";
            for ($i=0; $i <count($_POST["idioma"]) ; $i++) {
                $idiomas.=$_POST['idioma'][$i]. " ";
            }
        }
        return $idiomas;
    }
    function devulveCodigosPostales(){
        $codigosPostales="El usuario no ha selccionado ninguna ciudad";
        if (isset($_POST["ciudades"])) {
            $codigosPostales="El usuario ha seleccionado: ";
            foreach ($_POST["ciudades"] as $key => $value) {
                $codigosPostales.="$value " ;
            }
        }
        return $codigosPostales;
    }


?>