<?php


class Cliente{
    private int $codCliente;
    private String $nombre;
    private String $clave;
    private int $veces;


    public function __get($name){return $this->$name;}
    public function __set($name, $value){$this->$name = $value;}

    public function __construct(){
        $this->veces = 0;
        $this->db=AccesoDatos::getModelo();
    }

    //update
    public function updateCliente(){
        $db = AccesoDatos::getModelo();
        $stm_update   = $db->dbh->prepare("UPDATE clientes SET nombre = ?,clave = ?, veces=? WHERE cod_cliente=?");
        $stm_update->setFetchMode(PDO::FETCH_CLASS, 'Cliente');
        if ( $stm_update == false) die (AccesoDatos::getModelo()->dbh->error);

        // Enlazo ?
        $stm_update->bindValue(1,$this->nombre);
        $stm_update->bindValue(2,$this->clave);
        $stm_update->bindValue(3,$this->veces);
        $stm_update->bindValue(4,$this->cod_cliente);

        // Ejecuto la sentencia y compruebo si ha sido existosa
        if ( $stm_update->execute() ){
        return $stm_update->rowCount()==1;
        }
    }
    public function getTotalOrders($orders){
        $suma = 0;
        foreach ($orders as $key => $value) {
            $suma += $value->precio;
        }
        return $suma;
    }

}