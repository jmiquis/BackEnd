<?php

class Utils{

	public static function deleteSession($name){
		if(isset($_SESSION[$name])){
			$_SESSION[$name] = null;
			unset($_SESSION[$name]);
		}

		return $name;
	}

	public static function isAdmin(){
		if(!isset($_SESSION['admin'])){
			header("Location:".base_url);
		}else{
			return true;
		}
	}

	public static function isIdentity(){
		if(!isset($_SESSION['identity'])){
			header("Location:".base_url);
		}else{
			return true;
		}
	}

	public static function showCategorias(){
		require_once 'models/Categoria.php';
		$categoria  = new Categoria();
		$categorias = $categoria->getAll();
		return $categorias;
	}

	public static function statsCarrito(){
		$stats = array(
			'count' => 0,
			'total' => 0
		);

		if(isset($_SESSION['carrito'])){
			$stats['count'] = count($_SESSION['carrito']);

			foreach($_SESSION['carrito'] as $producto){
				$stats['total'] += $producto['precio']*$producto['unidades'];
			}
		}

		return $stats;
	}

	public static function showStatus($status){
		$value = 'Pendiente';

		if     ($status == 'confirm'){
		    $value = 'Pendiente';

		}elseif($status == 'preparation'){
			$value = 'En preparación';

		}elseif($status == 'ready'){
			$value = 'Preparado para enviar';

		}elseif($status == 'sended'){
			$value = 'Enviado';
		}

		return $value;
	}
	//devuleve todos los roles usados en la base de datos
	public static function getAllRoles():array{

		Self::isAdmin();

		$result   = Database::connect()->query("SELECT DISTINCT rol from usuarios");
		$rolArray = [];

		while ($row = $result ->  fetch_array(MYSQLI_NUM) ){

			$rolArray [] = $row[0];

		}

		return $rolArray;
	}

	public static function getAllEmails(){

		$database   = Database::connect();
		$emailArray = [];
		$getAllEmailsStatement = $database -> prepare("SELECT DISTINCT email FROM usuarios;");
		if(!$getAllEmailsStatement->execute())return false;

		$getAllEmailsStatementResult = $getAllEmailsStatement->get_result();
		while ($row = $getAllEmailsStatementResult -> fetch_array(MYSQLI_NUM)) {
			$emailArray[] = $row[0];
		}
		return $emailArray;
	}



	//sube una imagen a la carpeta uploads y retorna su path
	public static function uploadImage (String $nombreImagen) {
		$file     = $_FILES[$nombreImagen];
				$filename = $file['name'];
				$mimetype = $file['type'];

				if($mimetype == "image/jpg" || $mimetype == 'image/jpeg' || $mimetype == 'image/png' || $mimetype == 'image/gif'){

					if(!is_dir('uploads/images')){
						mkdir('uploads/images', 0777, true);
					}


					move_uploaded_file($file['tmp_name'], 'uploads/images/'.$filename);

					return $filename;
				}
	}
		//muestra error si el login en la pantalla de inicio no es correcto
	public static function showsLoginErrorMsg(){
		$msg="";

		if (isset($_SESSION['error_login'])) $msg=$_SESSION['error_login'];

		Self::deleteSession("error_login");

		return $msg;
	}

	public static function checksNonAdminId($id){

		return Self::isIdentity() && $_SESSION['identity']['id'] === $id;

	}

	public static function  checkFreeOrdersUser():array{

		$usersWhithOpenOrders = [];
		$database             = Database::connect();

		$getUsersPendingOrders = $database->query(" SELECT DISTINCT usuario_id FROM pedidos WHERE  estado like 'confirm' or estado like 'preparation';");
		if(!$getUsersPendingOrders)return false;


		while($row = $getUsersPendingOrders->fetch_array()){
			$usersWhithOpenOrders[] = $row[0];
		}
		return $usersWhithOpenOrders;

	}


}


