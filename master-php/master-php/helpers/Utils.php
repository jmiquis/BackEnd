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


	private static function databaseElementsGetter(String $preparedQuery):array{

		$resultArray       = [];
		$database          = Database::connect();
		$preaparedSttmnt   = $database->prepare("$preparedQuery");

		if(!$preaparedSttmnt->execute()) return false;
		$getElementsResult = $preaparedSttmnt->get_result();

		while($row = $getElementsResult->fetch_array(MYSQLI_NUM)) $resultArray[] = $row[0];

		return $resultArray;

	}

	public static function getAllRoles():array        {return Self::databaseElementsGetter("SELECT DISTINCT rol        FROM usuarios");}

	public static function getAllEmails():array       {return Self::databaseElementsGetter("SELECT DISTINCT email      FROM usuarios");}

	public static function checkFreeOrdersUser():array{return Self::databaseElementsGetter("SELECT DISTINCT usuario_id FROM pedidos WHERE  estado like 'confirm' or estado like 'preparation'");}

	public static function getAllOrderStatus():array  {return Self::databaseElementsGetter("SELECT DISTINCT estado     FROM pedidos");}




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






}


