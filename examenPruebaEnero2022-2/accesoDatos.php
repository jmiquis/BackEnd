<?php

class accesoDatos{

    private static $modelo         = null;
    private $dbh                   = null;
    private $getAllProductosSTM    = null;
    private $applyDiscountSTM      = null;
    private $getNotSoldProductsSTM = null;
    private $deleteProductSTM      = null;
    private $insertProduct         = null;

    public static function getModelo(){
        if (self::$modelo == null){
            self::$modelo = new AccesoDatos();
        }
        return self::$modelo;
    }

    // Constructor privado  Patron singleton

    private function __construct(){

        try {
            $dsn = "mysql:host=localhost:3308;dbname=empresa";
            $this->dbh = new PDO($dsn, "root", "root");
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e){
            echo "Error de conexión ".$e->getMessage();
            exit();
        }

        $this->applyDiscountSTM      = $this->dbh->prepare("UPDATE productos SET PRECIO_ACTUAL=PRECIO_ACTUAL-(PRECIO_ACTUAL*0.10) WHERE PRODUCTO_NO = :producto_no");
        $this->getNotSoldProductsSTM = $this->dbh->prepare("SELECT * FROM productos WHERE PRODUCTO_NO NOT IN(SELECT PRODUCTO_NO FROM pedidos)");
        $this->deleteProductSTM      = $this->dbh->prepare("DELETE  FROM  productos WHERE PRODUCTO_NO = :producto_no");
        $this->insertProduct         = $this->dbh->prepare("INSERT  INTO  productos VALUES (NULL, :descripcion, :precio_actual,:stock_disponible");
    }

    // Cierro la conexión anulando todos los objectos relacioanado con la conexión PDO (stmt)
    public static function closeModelo(){
        if (self::$modelo != null){
            $obj = self::$modelo;
            $obj->dbh = null;
            self::$modelo = null; // Borro el objeto.
        }
    }

    public function getProducts(){
        $this->getNotSoldProductsSTM->setFetchMode(PDO::FETCH_CLASS, 'Producto');
        if($this->getNotSoldProductsSTM->execute()){
            return $this->getNotSoldProductsSTM->fetchAll();
        }
    }

    public function updateProducts(Array $productsArray){
        foreach ($productsArray as $key=>$value){
            $this->applyDiscountSTM->bindParam(":producto_no",$value);
            return $this->applyDiscountSTM->execute();
        }
    }

    public function createProduct($description,$cost,$stock){
        $this->insertProduct->bindParam(1,$description);
        $this->insertProduct->bindParam(2,$cost);
        $this->insertProduct->bindParam(3,$stock);
        $this->insertProduct->execute();
        return  $this->insertProduct->rowCount()==1 ? true:false;
    }
}