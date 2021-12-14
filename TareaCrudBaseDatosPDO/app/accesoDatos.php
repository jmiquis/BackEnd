<?php
require_once "Producto.php";
require_once "configProductosPDO.php";

/*
 * Acceso a datos con BD Productos :
 * Usando la librería mysqli
 * Uso el Patrón Singleton :Un único objeto para la clase
 * Constructor privado, y métodos estáticos
 */
class AccesoDatos {

    private static $modelo          = null;
    private $dbh                    = null;
    private $stmt_productos         = null;
    private $stmt_producto          = null;
    private $stmt_borrarProducto    = null;
    private $stmt_modificarProducto = null;
    private $stmt_crearProducto     = null;


    public static function getModelo(){
        if  (self::$modelo == null){
                self::$modelo = new AccesoDatos();
        }
        return self::$modelo;
    }



   // Constructor privado  Patron singleton

    private function __construct(){

        try {
            $dsn = "mysql:host=".DB_SERVEREMP.";dbname=".DATABASEEMP.";charset=utf8";
            $this->dbh = new PDO($dsn, "root", "root");
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e){
            echo "Error de conexión ".$e->getMessage();
            exit();
        }
        // Construyo las consultas
        $this->stmt_productos           = $this->dbh->prepare("select * from productos");
        $this->stmt_producto            = $this->dbh->prepare("select * from productos where producto_no=:producto_no");
        $this->stmt_borrarProducto      = $this->dbh->prepare("delete from productos where producto_no =:producto_no");
        $this->stmt_modificarProducto   = $this->dbh->prepare("update productos set descripcion=:descripcion, precio_actual=:precio_actual, stock_disponible=:stock_disponible where producto_no=:producto_no");
        $this->stmt_crearProducto       = $this->dbh->prepare("insert into productos (producto_no,descripcion,precio_actual,stock_disponible) Values(?,?,?,?)");
    }

    // Cierro la conexión anulando todos los objectos relacionado con la conexión PDO (stmt)
    public static function closeModelo(){

        if (self::$modelo != null){
            $obj                         = self::$modelo;

            $obj->stmt_productos         = null;
            $obj->stmt_producto          = null;
            $obj->stmt_borrarProducto    = null;
            $obj->stmt_moduser           = null;
            $obj->stmt_modificarProducto = null;
            $obj->dbh                    = null;
            self::$modelo                = null; // Borro el objeto.
        }

    }


    // SELECT Devuelvo la lista de productos
    public function getTodosProductos ():array {
        $arrayProductos = [];
        $this->stmt_productos->setFetchMode(PDO::FETCH_CLASS, 'Producto');
        if ( $this->stmt_productos->execute() ){
            while ( $producto = $this->stmt_productos->fetch()){
               $arrayProductos[]= $producto;
            }
        }
        return $arrayProductos;
    }

    //  Devuelvo un producto o false
    public function getProductoConcreto (int $numeroProducto):false|Producto {
        $producto = false;

        $this->stmt_producto->setFetchMode(PDO::FETCH_CLASS, 'Producto');
        $this->stmt_producto->bindParam(':producto_no', $numeroProducto);
        if ( $this->stmt_producto->execute() ){
             if ( $obj = $this->stmt_producto->fetch()){
                $producto= $obj;
            }
        }
        return $producto;
    }


    // UPDATE
    public function modificarProducto(Producto $producto):bool{

        $this->stmt_modificarProducto->bindValue(':producto_no'     ,$producto->PRODUCTO_NO          );
        $this->stmt_modificarProducto->bindValue(':descripcion'     ,$producto->DESCRIPCION          );
        $this->stmt_modificarProducto->bindValue(':precio_actual'   ,$producto->PRECIO_ACTUAL        );
        $this->stmt_modificarProducto->bindValue(':stock_disponible',$producto->STOCK_DISPONIBLE     );
        $this->stmt_modificarProducto->execute();
        return ($this->stmt_modificarProducto->rowCount () == 1)? true:false;

    }

    //INSERT
    public function addProducto(Producto $producto):bool{

        $this->stmt_crearProducto->execute(
            [
            $producto->PRODUCTO_NO,
            $producto->DESCRIPCION,
            $producto->PRECIO_ACTUAL,
            $producto->STOCK_DISPONIBLE
            ]

        );
        return ($this->stmt_crearProducto->rowCount () == 1)? true:false;

    }

    //DELETE
    public function borrarProducto(int $numeroProducto):bool {
        $this->stmt_borrarProducto->bindParam(":producto_no",$numeroProducto);
        $this->stmt_borrarProducto->execute();
        return ($this->stmt_borrarProducto->rowCount () == 1)? true:false;
    }

     // Evito que se pueda clonar el objeto. (SINGLETON)
    public function __clone()
    {
        trigger_error('La clonación no permitida', E_USER_ERROR);
    }
}

