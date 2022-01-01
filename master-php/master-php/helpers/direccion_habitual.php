<?php
//clase auxiliar de usuario
//las consultas están orientadas a usarse desde la clase usuario

     class Direccion_habitual{

       private          $db;
       private int      $id_direccion_habitual;
       private String   $provincia;
       private String   $localidad;
       private String   $direccion_usuario;

       public function __construct(){
        $this->db = Database::connect();
       }

       public function __set($name, $value){$this->$name=$value;}
       public function __get($name){return $this->$name;}

       //insert

       public function save(){
            $saveStm = $this->db->prepare("INSERT INTO direccion_habitual VALUES (NULL,?,?,?)");
            $saveStm->bind_param("sss",$this->provincia,$this->localidad,$this->direccion);
            $saveStm->execute();
            $this->id_direccion_habitual = $saveStm->insert_id;
            return ($this->db->affected_rows  == 1) ? true : false;
       }

       //delete
       public function deleteAdress($id){
            $statementDeleteAdress = $this->db->prepare("DELETE FROM direccion_habitual WHERE id_usuario= ?");
            if(!$statementDeleteAdress)return false;
		    $statementDeleteAdress->bind_param("i",$id);
            $statementDeleteAdress->execute();
            return ($this->db->affected_rows  == 1) ? true : false;
       }

       //update

       public function updateAdress($id_usuario,$provincia,$localidad,$direccion){

            $statementUpdateAdress = $this->db->prepare("UPDATE direccion_habitual SET provincia=?,localidad=?,direccion=? WHERE id_usuario=?");
            if(!$statementUpdateAdress)return false;
            $statementUpdateAdress->bind_param("sssi",$provincia,$localidad,$direccion,$id_usuario);
            $statementUpdateAdress->execute();
            return ($this->db->affected_rows  == 1) ? true : false;
       }





    }
