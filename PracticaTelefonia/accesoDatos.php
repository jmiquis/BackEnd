<?php
require_once 'Cliente.php';
class AccesoDatos{

    private static $modelo            = null;
    private $dbh                      = null;
    private $getAllFilteredClientsSTM = null;
    private $getAllClientsSTM         = null;

    public static function getModelo(){
        if (self::$modelo == null){
            self::$modelo = new AccesoDatos();
        }
        return self::$modelo;
    }

    // Constructor privado  Patron singleton

    private function __construct(){

        try {
            $dsn = "mysql:host=localhost:3308;dbname=telefonia";
            $this->dbh = new PDO($dsn, "root", "root");
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e){
            echo "Error de conexión ".$e->getMessage();
            exit();
        }

        $this->getAllFilteredClientsSTM      = $this->dbh->prepare("SELECT * FROM clientes WHERE puntos>=?");
        $this->getAllClientsSTM              = $this->dbh->prepare("SELECT * FROM  clientes");
        $this->getMaxNumberOfPoints          = $this->dbh->prepare("SELECT max(puntos) FROM clientes");

    }

    // Cierro la conexión anulando todos los objectos relacioanado con la conexión PDO (stmt)
    public static function closeModelo(){
        if (self::$modelo != null){
            $obj = self::$modelo;
            $obj->dbh = null;
            self::$modelo = null; // Borro el objeto.
        }
    }

    public function getClients(){
        $this->getAllClientsSTM->setFetchMode(PDO::FETCH_CLASS, 'Cliente');
        if($this->getAllClientsSTM->execute()){
            return $this->getAllClientsSTM->fetchAll();
        }
    }

    public function getFilteredClients($param){
        $this->getAllFilteredClientsSTM->setFetchMode(PDO::FETCH_CLASS,'Cliente');
        $this->getAllFilteredClientsSTM->bindValue(1,$param);
        $this->getAllFilteredClientsSTM->execute();
        return $this->getAllFilteredClientsSTM->fetchAll();
    }

    public function getMax(){
            $this->getMaxNumberOfPoints->execute();
            return $resultado =$this->getMaxNumberOfPoints->fetch(PDO::FETCH_NUM)[0];
    }



}

