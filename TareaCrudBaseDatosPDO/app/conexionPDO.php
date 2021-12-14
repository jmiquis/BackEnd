<?php

    //se crea el objeto PDO en un try catch

try {
        $dsn = "mysql:host=127.0.0.1:3308;dbname=EMPRESA";
        $dbh = new PDO($dsn, "root", "root");
        // $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e){
        echo "Error de conexión ".$e->getMessage();
        exit();
    }

    
?>