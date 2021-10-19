<!-- Realizar el programa registrar.php que sirva para dar de alta usuarios en el sistema. El programa mostrará un formulario donde se solicitará un nombre, un correo electrónico y la contraseña dos veces. El programa comprobará que ningún campo está vacío que el correo tiene un valor correcto de email y que los dos valores de la contraseña coinciden.
La contraseña tiene que ser segura para ello tiene que cumplir las siguientes reglas:
1º Tamaño  igual o superior a 8 caracteres en total.
2º Contiene  caracteres alfabéticos donde hay mayúsculas o minúsculas (una como mínimo de cada).
3º Contiene algún dígito.
4º Contiene algún carácter no alfanumérico ni dígito ni alfabético.

El programa mostrará en mensaje: Usuario registrado o error indicado el tipo de error producido debido a que falta un dato, la contraseñas no coinciden o no cumplen alguna de las reglas de seguridad.
Nota: Si es posible el chequeo también se hará, por lo menos lo más sencillo, en la parte cliente (javascripts) -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="02.php" method="post">
        user: <p><input type="text" name="user" id="" value="<?=isset($_POST["user"])?$_POST["user"]:"" ?>"></p>
        email: <p><input type="email" name="mail" id="" value="<?=isset($_POST["mail"])?$_POST["mail"]:"" ?>"></p>
        password: <p><input type="password" name="password" id=""></p>
        repetir password:<p><input type="password" name="password2" id=""></p>
        <input type="submit" value="boton">
    </form>

    <?php if($_SERVER["REQUEST_METHOD"]=="POST"):?>
        <?php

    //checks


        //check mail
            function isMail($string){
                return  filter_var($string,FILTER_VALIDATE_EMAIL);
            }
        //checks de contraseña

            //check longitud password
            function passLength($password){
                if (strlen($password)<8) {
                    echo("la contraseña es demasiado corta <br><br>");
                    return false;
                }
                return true;
            }

            //check de caracteres
            function checkCaracteres($password){
               $mayusculas=0;
               $minusculas=0;
               $numero=0;
               $noAlfanumerico=0;

               for($i=0;$i<strlen($password);$i++){
                    if(!ctype_alnum($password[$i])){
                        $noAlfanumerico++;
                    }
                    else{
                        if(is_numeric($password[$i]))
                            $numero++;
                        if(ctype_upper($password[$i])){
                            $mayusculas++;
                        }
                        if(ctype_lower($password[$i])){
                            $minusculas++;
                        }
                    }
                    if ($noAlfanumerico>0 && $minusculas>0 && $numero>0 && $noAlfanumerico>0){
                        return true;
                    }
               }

            }
        //check passwordIguales
            function checkPass($password,$password2){
                return $password===$password2;
            }

        //check no vacio
            //nombre
            function devuelveNombre(&$nombre){
                if(!(empty($nombre))){
                    $nombre=checkSeguridad($nombre);
                    return true;
                }
                else{
                    echo("El nombre no puede estar vacio <br><br>" );
                    return false;
                }
            }
            //mail
            function checkMail(&$mail){
                if (!empty($mail)) {
                    if(!isMail($mail)){
                        echo("la direccion de mail no es valida <br><br>");
                        return false;
                    }
                    else{
                        $mail=checkSeguridad($_POST["mail"]);
                        return true;
                    }
                }
                else{
                    echo("El mail no puede estar vacio <br><br>");
                    return false;
                }
            }
            //password
            function checkeoPasswords(&$password,$password2){
                if (!empty($password)) { //si la contraseña no esta vacia

                    if(checkPass($password,$password2)){// si las dos son iguales

                        if (passLength($password)) { //si tiene 8 o mas caracteres

                            if (checkCaracteres($password)) {//si es segura
                                $password=checkSeguridad($password);
                                return true;
                            }
                            else{
                                echo("la contraseña no es segura<br><br>");
                                return false;
                            }
                        }
                        else{
                            echo("la contraseña es demasiado corta<br><br>");
                            return false;
                        }
                    }
                    else{
                        echo("Las contraseñas no coinciden<br><br>");
                        return false;
                    }
                }
                else{
                    echo("La contraseña no puede estar vacia<br><br>");
                }
            }
    //fun auxiliares
            function checkSeguridad($cadena ){
                $cadena=trim($cadena); // Elimina espacios antes y después de los datos
                $cadena=stripslashes($cadena); // Elimina backslashes \
                $cadena=htmlspecialchars($cadena); // Traduce caracteres especiales en entidades HTML
                return $cadena;
                }

    //llamadas

        function general(){
            $password=$_POST["password"];
            $password2=$_POST["password2"];
            $nombre=$_POST["user"];
            $mail=$_POST["mail"];

            if(checkMail($mail) && checkeoPasswords($password,$password2) && devuelveNombre($nombre)){
                echo("usuario registrado<br><br>");
            }
        }
        general();

        ?>
    <?php endif ?>
</body>
</html>