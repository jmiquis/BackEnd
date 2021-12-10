<?php
require_once "Producto.php";
require_once "configProductos.php";

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

         $this->dbh = new mysqli(DB_SERVER,DB_USER,DB_PASSWD,DATABASE);

      if ( $this->dbh->connect_error){
         die(" Error en la conexión ".$this->dbh->connect_errno);
      }

        // CONSULTAS PREPARADAS

        //nombre de sentencia preparada                             //sentencia

        $this->stmt_productos             =  $this->dbh-> prepare   ("select * from PRODUCTOS");
        if ($this->stmt_productos         == false) die(__FILE__ . ':' . __LINE__ . $this->dbh->error);

        $this->stmt_producto              =  $this->dbh-> prepare   ("select * from PRODUCTOS where producto_no =?");
        if  ($this->stmt_producto         == false) die($this->dbh->error);

        $this->stmt_borrarProducto        =  $this->dbh-> prepare  ("delete from PRODUCTOS where producto_no =?");
        if  ($this->stmt_borrarProducto   == false) die($this->dbh->error);

        $this->stmt_modificarProducto     =  $this->dbh-> prepare  ("update PRODUCTOS set descripcion=?, precio_actual=?, stock_disponible=? where producto_no=?");
        if ($this->stmt_modificarProducto == false)  die($this->dbh->error);

        $this->stmt_crearProducto         =  $this->dbh-> prepare  ("insert into PRODUCTOS (producto_no,descripcion,precio_actual,stock_disponible) Values(?,?,?,?)");
        if ($this->stmt_crearProducto     == false) die($this->dbh->error);
    }

    // Cierro la conexión anulando todos los objectos relacionado con la conexión PDO (stmt)
    public static function closeModelo(){

        if (self::$modelo != null){
                $obj          = self::$modelo;
                // Cierro la base de datos
                $obj->dbh->close();
                self::$modelo = null; // Borro el objeto.
        }

    }


    // SELECT Devuelvo la lista de Usuarios
    public function getTodosProductos ():array {
        $arrayProductos = [];

        //llama a la sentencia preparada que devuelve el array de todos los productos
        $this->stmt_productos->execute();//ejecuta las sentencias preparadas

        //obtiene un resultset de una sentencia preparada y lo mete en una variable
        $result = $this->stmt_productos->get_result();

        if ( $result ){//si no es nulo

            while ( $producto = $result->fetch_object('Producto')){//lo recorre

               $arrayProductos[]= $producto;//y mete los resultados en la variable a retornar

            }
        }
        return $arrayProductos;
    }

    // SELECT Devuelvo un producto o false
    public function getProductoConcreto (int $numeroProducto):false|Producto {
        $producto = false;
        //la sentencia necesita parametros
        $this->stmt_producto->bind_param("i",$numeroProducto);//los parametros se agregan con blind_param
        $this->stmt_producto->execute();
        $result = $this ->stmt_producto->get_result();

        if ( $result ){
            $producto = $result->fetch_object('Producto');
        }

        return $producto;
    }

    // UPDATE
    public function modificarProducto(Producto $producto):bool{

        $this->stmt_modificarProducto->bind_param("sdii",
            $producto->DESCRIPCION,
            $producto->PRECIO_ACTUAL,
            $producto->STOCK_DISPONIBLE,
            $producto->PRODUCTO_NO
        );

        $this->stmt_modificarProducto->execute();
        $resu = ($this->dbh->affected_rows  == 1);
        return $resu;
    }

    //INSERT
    public function addProducto(Producto $producto):bool{

        $this->stmt_crearProducto->bind_param("isdi",
            $producto->PRODUCTO_NO,
            $producto->DESCRIPCION,
            $producto->PRECIO_ACTUAL,
            $producto->STOCK_DISPONIBLE
        );
        $this->stmt_crearProducto->execute();
        $resu = ($this->dbh->affected_rows  == 1);
        return $resu;
    }

    //DELETE
    public function borrarProducto(int $numeroProducto):bool {
        $this->stmt_borrarProducto->bind_param("i", $numeroProducto);
        $this->stmt_borrarProducto->execute();
        $resu = ($this->dbh->affected_rows  == 1);
        return $resu;
    }

     // Evito que se pueda clonar el objeto. (SINGLETON)
    public function __clone()
    {
        trigger_error('La clonación no permitida', E_USER_ERROR);
    }
}

