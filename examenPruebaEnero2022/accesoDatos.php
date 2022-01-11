<?php

class AccesoDatos{
    private static $modelo = null;
    private $dbh = null;

    public static function getModelo(){
        if (self::$modelo == null){
            self::$modelo = new AccesoDatos();
        }
        return self::$modelo;
    }
    public function __get($name){return $this->$name;}
    public function __set($name, $value){$this->$name = $value;}

    private function __construct(){

        $this->dbh = new mysqli("127.0.0.1:3308","root","root","etienda");

       if ( $this->dbh->connect_error){
        die(" Error en la conexión ".$this->dbh->connect_errno);
       }

       try {
           $dsn = "mysql:host=localhost:3308;dbname=etienda;charset=utf8";
           $this->dbh = new PDO($dsn,'root','root');
           $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       } catch (PDOException $e){
           echo "Error de conexión ".$e->getMessage();
           exit();
       }
   }
   // Cierro la conexión anulando todos los objectos relacioanado con la conexión PDO (stmt)
   public static function closeModelo(){
    if (self::$modelo != null){
        // Cierro la base de datos
        self::$dbh = null;
        self::$modelo = null; // Borro el objeto.
    }
}


    public static function getUser($nombreCliente){
        $cliente = false;

        $stmt_clientes   = Self::getModelo()->dbh->prepare("SELECT * FROM clientes WHERE nombre LIKE ?");
        $stmt_clientes->setFetchMode(PDO::FETCH_CLASS, 'Cliente');
        if ( $stmt_clientes == false) die (Self::getModelo()->dbh->error);

        // Enlazo $npro con el primer ?
        $stmt_clientes->bindValue(1,$nombreCliente);

        // Ejecuto la sentencia y compruebo si ha sido existosa
        if ( $stmt_clientes->execute() ){
            $cliente = $stmt_clientes->fetch();}

        return $cliente;
    }

    public function getOrdersByClient($id){
        $pedidos = [];

        $stmt_pedidos   = Self::getModelo()->dbh->prepare("SELECT * FROM pedidos WHERE cod_cliente = ?");
        $stmt_pedidos->setFetchMode(PDO::FETCH_CLASS, 'Pedido');
        if ( $stmt_pedidos == false) die (Self::getModelo()->dbh->error);

        // Enlazo $npro con el primer ?
        $stmt_pedidos->bindValue(1,$id);

        // Ejecuto la sentencia y compruebo si ha sido existosa
        if ( $stmt_pedidos->execute() ){
            while($row=$stmt_pedidos->fetch()){
                $pedidos[]=$row;
            }
        }
        return $pedidos;
    }
}