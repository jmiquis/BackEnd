<?php

class Categoria{
	private $id;
	private $nombre;
	private $db;

	public function __construct() {
		$this->db = Database::connect();
	}

	function getId() {
		return $this->id;
	}

	function getNombre() {
		return $this->nombre;
	}

	function setId($id) {
		$this->id = $id;
	}

	function setNombre($nombre) {
		$this->nombre = $this->db->real_escape_string($nombre);
	}

	public function getAll(){
		$categorias = $this->db->query("SELECT * FROM categorias ORDER BY id DESC;");
		return $categorias;
	}

	public function getOne(){
		$categoria = $this->db->query("SELECT * FROM categorias WHERE id={$this->getId()}");
		return $categoria->fetch_object();
	}

	public function getOneCategory($id):Categoria{
		$getOneStm = $this->db->prepare("SELECT * FROM categorias WHERE id = ?");
		if(!$getOneStm)return false;
		$getOneStm->bind_param("i",$id);
		$getOneStm->execute();
		$category = $getOneStm->get_result()->fetch_object("Categoria");
		$getOneStm->close();
		return $category;
	}


	//insert
	public function save(){
		$sql = "INSERT INTO categorias VALUES(NULL, '{$this->getNombre()}');";
		$save = $this->db->query($sql);

		$result = false;
		if($save){
			$result = true;
		}
		return $result;
	}
	//update
	public function updateCategory($name,$id){
		$modifySTM = $this->db->prepare("UPDATE categorias SET nombre = ? WHERE id = ?");
		if(!$modifySTM)return false;
		$modifySTM->bind_param("si",$name,$id);
		$modifySTM->execute();
		return ($this->db->affected_rows  == 1) ? true : false;
	}
	//delete
	public function deleteCategory($id){
		$deleteSTM = $this->db->prepare("DELETE FROM categorias WHERE id=?");
		if(!$deleteSTM)return false;
		$deleteSTM->bind_param("i",$id);
		$deleteSTM->execute();
		$execution = $deleteSTM->affected_rows;
		switch($execution){
			case 1:
				return true;

			case -1:
				$_SESSION['UserManagementMsg'] = $deleteSTM->error;
				return false;
		}
	}

	public function getTotalSold(){
		$stm = $this->db->prepare("SELECT sum(pr.precio * l.unidades) AS total FROM productos pr,lineas_pedidos l WHERE pr.id=l.producto_id AND pr.categoria_id = ?");
		if(!$stm)return false;
		$stm->bind_param("i",$this->id);
		$stm->execute();
		$result = $stm->get_result();
		$result = $result->fetch_array(MYSQLI_NUM)[0];
		return number_format($result,2,",");
	}

	public function getStockValue(){
		$stm = $this->db->prepare("SELECT sum(precio*stock) FROM productos WHERE categoria_id = ?");
		if(!$stm)return false;
		$stm->bind_param("i",$this->id);
		$stm->execute();
		$result = $stm->get_result();
		$result = $result->fetch_array(MYSQLI_NUM)[0];
		return number_format($result,2,",");
	}


}