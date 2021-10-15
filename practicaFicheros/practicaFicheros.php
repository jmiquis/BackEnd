
<!DOCTYPE html>
<?php if($_SERVER["REQUEST_METHOD"]=="GET"):?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <form enctype="multipart/form-data" action="practicaFicheros.php" method="POST">
        <label for="directorio">adjunte los archivos</label><br><br>
        seleccionar carpeta destino:<input type="text" name="directorio" value=""><br><br>
        <input type="file" name="archivo[]" value="examinar..." multiple accept="image/jpeg | image/jpeg"><br><br>
        <input type="hidden" name="MAX_FILE_SIZE" value="200000" />
        <input type="submit" value="enviar">
    </form>


<?php else :?>
    <?php

        $archivosRechazados=[];
        $erroresPHP=[
            UPLOAD_ERR_OK         => 'Subida correcta',  // Valor 0
            UPLOAD_ERR_INI_SIZE   => 'El tamaño del archivo excede el admitido por el servidor',  // directiva upload_max_filesize en php.ini
            UPLOAD_ERR_FORM_SIZE  => 'El tamaño del archivo excede el admitido por el cliente',  // directiva MAX_FILE_SIZE en el formulario HTML
            UPLOAD_ERR_PARTIAL    => 'El archivo no se pudo subir completamente',
            UPLOAD_ERR_NO_FILE    => 'No se seleccionó ningún archivo para ser subido',
            UPLOAD_ERR_NO_TMP_DIR => 'No existe un directorio temporal donde subir el archivo',
            UPLOAD_ERR_CANT_WRITE => 'No se pudo guardar el archivo en disco',  // permisos
            UPLOAD_ERR_EXTENSION  => 'Una extensión PHP evito la subida del archivo',  // extensión PHP
        ];

        //si no se especifica la carpeta de destino. Sin carpeta no contiua
        function carpetaExiste(){
            if (empty($_POST["directorio"])) {
                exit ("No se ha especificado ninguna carpeta de destino");
           }
           else
           return $_POST["directorio"];
        }
        //si no se envia ningun archivo. Sin archivo no continua
        function comprobacionExiste(){
            if ($_FILES["archivo"]["name"][0]=="") {
                exit ("No se ha adjuntado ningun archivo");
           }
           else
           return $_FILES["archivo"];
        }

        //comprueba la carpeta de destino. Si la carpeta de destino no se puede abrir se interrumpe.
        function compruebaCarpeta($carpetaDestino){

            if(!is_writable($carpetaDestino)){
                exit ("la carpeta no existe o no se puede abrir");
            }
            return true;
        }
        //pinta el mensaje inicial del proceso
        function inicioProceso($archivo){
            for ($i=0; $i < count($archivo["name"]); $i++) {
               echo("intentando subir archivo: ".$archivo["name"][$i])." <br>";
               echo("tipo de archivo: ".$archivo["type"][$i]." <br>");
               echo("tamaño de fichero: ".$archivo["size"][$i]." kilobytes <br>" );
               echo("fichero temporal: ".$archivo["tmp_name"][$i]."<br>");
               echo("<br> <br> <br>" );
            }
        }

        // El tamaño máximo de los ficheros no puede superar los 200 Kbytes cada uno
        function checkCadaArchivo($archivo){
            global $archivosRechazados;
            for ($i=0; $i <count($archivo["size"]) ; $i++) {
                if ($archivo["size"][$i]>200000) {
                        agregarARechazados($i);
                        echo("El archivo ".$archivo["name"][$i]." excede el tamaño límite de 200 kb <br>");
                }
            }
        }

        // y entre todos no mas de 300  Kbytes.
        function checkSizesTotal($archivo){
            $suma=0;
            foreach ($archivo["size"] as $key => $value) {
               $suma+=intval($archivo["size"]);

               if ($suma>300000) {
                  exit ("El tamaño total excede al limite");
               }
            }
        }
        //Los ficheros tienes que ser o JPEG o PNG no se admiten otros formatos.
        function checkExtension($archivo){
            global $archivosRechazados;

            foreach ($archivo["name"] as $key => $value) {

                $extension=pathinfo($value,PATHINFO_EXTENSION);

                if($extension!="JPEG" || $extension!="PNG" || $extension!="JPG"){

                    agregarARechazados($key);

                    echo ("El archivo $value tiene una extension no permitida en esta carpeta <br>");
                }
            }
        }

        //comprueba que no hay archivos en la carpeta de destino con el mismo nombre
        function noRepetidos($archivo,$carpetaDestino){
            global $archivosRechazados;
            $contenido=scandir($carpetaDestino);

            foreach ($archivo["name"] as $key => $value) {
                if (in_array($value,$contenido)) { //si el archivo esta en la carpeta
                    agregarARechazados($key);
                    echo("El archivo $value ya se encuentra en la carpeta de destino <br>");
                }
            }
        }

        //muestra los errores que lanza php
        function muestraErrores($archivo){
            global $erroresPHP;
            for ($i=0; $i <count($archivo["name"]) ; $i++) {
                $nombreArchivo=$archivo["name"][$i];
                $mensaje=($archivo["error"][$i]==0)?"sin errores PHP en el archivo $nombreArchivo":"error ".$archivo["error"][$i]." ( ".$erroresPHP[$archivo["error"][$i]] .")";
                echo("$mensaje <br>");
            }
        }

        //selecciona los archivos que han pasado los checks para probar a subir
        function copiando($archivo){
            global $archivosRechazados;
            global $carpetaDestino;
            for ($i=0; $i < count($archivo["tmp_name"]); $i++) {

                if (!in_array($i,$archivosRechazados)) {//si el archivo no esta en el array de rechazados
                    $temporal=$archivo["tmp_name"][$i];
                    $nombre=$archivo["name"][$i];
                    subirArchivo($temporal,$carpetaDestino,$nombre);
                }
            }
        }

         //funciones auxiliares
         function agregarARechazados($archivo){
            global $archivosRechazados;
            if(!in_array($archivo,$archivosRechazados)){
                array_push($archivosRechazados,$archivo);
            }
        }
        function subirArchivo($archivoTemporal,$carpeta,$nombreArchivo){
            $destino=$carpeta."/".$nombreArchivo;
            if (move_uploaded_file($archivoTemporal, $destino)){
             echo("$nombreArchivo envio ok <br> <br>");
            }
            else{
                echo("fallo al subir $nombreArchivo");
            }
        }
        function checkSeguridad($cadena ){
            $cadena=trim($cadena); // Elimina espacios antes y después de los datos
            $cadena=stripslashes($cadena); // Elimina backslashes \
            $cadena=htmlspecialchars($cadena); // Traduce caracteres especiales en entidades HTML
            return $cadena;
            }
        //llamada a funciones

            //comprobaciones
            echo("iniciando subida <br>");
            $archivo=comprobacionExiste();
            inicioProceso($archivo);
            $carpetaDestino=carpetaExiste();
            compruebaCarpeta($carpetaDestino);
            checkSizesTotal($archivo);
            checkCadaArchivo($archivo);
            noRepetidos($archivo,$carpetaDestino);
            muestraErrores($archivo);
            //subida
            copiando($archivo);



    ?>
<?php endif?>
</body>
</html>