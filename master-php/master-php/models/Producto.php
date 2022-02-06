<?php

class Producto{
	private $id;
	private $categoria_id;
	private $nombre;
	private $descripcion;
	private $precio;
	private $stock;
	private $oferta;
	private $fecha;
	private $imagen;

	private $db;

	public function __construct() {
		$this->db = Database::connect();
	}

	function getId() {
		return $this->id;
	}

	function getCategoria_id() {
		return $this->categoria_id;
	}

	function getNombre() {
		return $this->nombre;
	}

	function getDescripcion() {
		return $this->descripcion;
	}

	function getPrecio() {
		return $this->precio;
	}

	function getStock() {
		return $this->stock;
	}

	function getOferta() {
		return $this->oferta;
	}

	function getFecha() {
		return $this->fecha;
	}

	function getImagen() {
		return $this->imagen;
	}

	function setId($id) {
		$this->id = $id;
	}

	function setCategoria_id($categoria_id) {
		$this->categoria_id = $categoria_id;
	}

	function setNombre($nombre) {
		$this->nombre = $this->db->real_escape_string($nombre);
	}

	function setDescripcion($descripcion) {
		$this->descripcion = $this->db->real_escape_string($descripcion);
	}

	function setPrecio($precio) {
		$this->precio = $this->db->real_escape_string($precio);
	}

	function setStock($stock) {
		$this->stock = $this->db->real_escape_string($stock);
	}

	function setOferta($oferta) {
		$this->oferta = $this->db->real_escape_string($oferta);
	}

	function setFecha($fecha) {
		$this->fecha = $fecha;
	}

	function setImagen($imagen) {
		$this->imagen = $imagen;
	}

	public function getAllPaginated($pageNumber){

		$init = ($pageNumber-1)*ITEMSPERPAGE;
		$paginatedSTM = $this->db->prepare("SELECT * FROM productos ORDER BY id ASC LIMIT ".$init.",".ITEMSPERPAGE);
		$paginatedSTM->execute();
		return $paginatedSTM->get_result();
	}

	public function getTotalNumberOfProducts():int{
		$stm                 = $this->db->prepare("SELECT * FROM productos");
		if(!$stm) return false;
		if(!$stm->execute()) return false;
		$getResults          = $stm->get_result();
		return $numberOfRows = mysqli_num_rows($getResults);
	}
	public function getAllProducts(){
		$productsArray = [];
		$stm = $this->db->prepare("SELECT * FROM productos ORDER BY id asc");
		if(!$stm) return false;

		if(!$stm->execute()) return false;
		$getResults = $stm->get_result();
		while($row = $getResults->fetch_object("Producto"))$productsArray[] = $row;

		return $productsArray;
	}

	public function getAllCategory(){
		$sql = "SELECT p.*, c.nombre AS 'catnombre' FROM productos p "
				. "INNER JOIN categorias c ON c.id = p.categoria_id "
				. "WHERE p.categoria_id = {$this->getCategoria_id()} "
				. "ORDER BY id DESC";
		$productos = $this->db->query($sql);
		return $productos;
	}
	public function getBargains(){
		$categorias = $this->db->query("SELECT * FROM productos WHERE oferta LIKE 'si' ORDER BY id " );
		return $categorias;
	}
	public function getTotalSoldsByProduct(){
		$id = $this->id;
		$getTotalSoldSTM = $this->db->prepare("SELECT sum(unidades) as 'total' FROM lineas_pedidos WHERE producto_id =?");
		if(!$getTotalSoldSTM)return false;
		$getTotalSoldSTM->bind_param("i",$id);
		$getTotalSoldSTM->execute();
		$total = $getTotalSoldSTM->get_result()->fetch_array()[0];
		$getTotalSoldSTM->close();
		return $total;
	}

	public function getRandom($limit){
		$productos = $this->db->query("SELECT * FROM productos ORDER BY RAND() LIMIT $limit");
		return $productos;
	}

	public function getOne(){
		$producto = $this->db->query("SELECT * FROM productos WHERE id = {$this->getId()}");
		return $producto->fetch_object();
	}

	public function getOneProduct($id):Producto{
		$getOneStm = $this->db->prepare("SELECT * FROM productos WHERE id = ?");
		if(!$getOneStm)return false;
		$getOneStm->bind_param("i",$id);
		$getOneStm->execute();
		$product = $getOneStm->get_result()->fetch_object("Producto");
		$getOneStm->close();
		return $product;

	}

	public function save(){
		$sql = "INSERT INTO productos VALUES(NULL, {$this->getCategoria_id()}, '{$this->getNombre()}', '{$this->getDescripcion()}', {$this->getPrecio()}, {$this->getStock()}, 'no', CURDATE(), '{$this->getImagen()}');";
		$save = $this->db->query($sql);

		$result = false;
		if($save){
			$result = true;
		}
		return $result;
	}

	public function edit(){
		$sql = "UPDATE productos SET nombre='{$this->getNombre()}', descripcion='{$this->getDescripcion()}', precio={$this->getPrecio()}, stock={$this->getStock()}, categoria_id={$this->getCategoria_id()}, oferta = '{$this->getOferta()}' ";

		if($this->getImagen() != null){
			$sql .= ", imagen='{$this->getImagen()}'";
		}

		$sql .= " WHERE id={$this->id};";


		$save = $this->db->query($sql);

		$result = false;
		if($save){
			$result = true;
		}
		return $result;
	}

	public function delete(){
		$sql = "DELETE FROM productos WHERE id={$this->id}";
		$delete = $this->db->query($sql);

		$result = false;
		if($delete){
			$result = true;
		}
		return $result;
	}
}
