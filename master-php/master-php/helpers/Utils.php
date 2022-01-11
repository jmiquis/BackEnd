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


	private static function getDatabaseElements(String $preparedQuery,bool $returnStdClass=false){

		$resultArray       = [];
		$database          = Database::connect();
		$preaparedSttmnt   = $database->prepare("$preparedQuery");

		if(!$preaparedSttmnt->execute()) return false;
		$getElementsResult = $preaparedSttmnt->get_result();

		if($returnStdClass){
			while($row = $getElementsResult->fetch_object()) $resultArray[]=$row;
			$preaparedSttmnt->close();
			return $resultArray;
		}
		while($row = $getElementsResult->fetch_array(MYSQLI_NUM)){
			$resultArray[] = $row[0];
		}

		$preaparedSttmnt->close();
		return $resultArray;

	}


	public static function getAllRoles():array{
		return Self::getDatabaseElements("SELECT DISTINCT rol        FROM usuarios");
	}

	public static function checkFreeOrdersUser():array{
		return Self::getDatabaseElements("SELECT DISTINCT usuario_id FROM pedidos WHERE  estado like 'confirm' or estado like 'preparation'");
	}

	public static function getAllOrderStatus():array  {
		return Self::getDatabaseElements("SELECT DISTINCT estado     FROM pedidos");
	}
	public static function getCategoriesWithProducts(){
		return Self::getDatabaseElements("SELECT DISTINCT categoria_id FROM productos");
	}
	public static function getProductsInOpenOrders(){
		return Self::getDatabaseElements("SELECT DISTINCT l.producto_id FROM lineas_pedidos l, pedidos p WHERE l.pedido_id=p.id AND p.estado not like 'sended';");
	}
	public static function getMostSoldProduct(){
		return Self::getDatabaseElements("SELECT p.*,sum(unidades) as ventas
		FROM productos p, lineas_pedidos l
		WHERE p.id=l.producto_id
		GROUP BY p.id
		ORDER BY 10 desc
		LIMIT 1;",true);
	}
	public static function getNotSoldProducts(){
		return Self::getDatabaseElements("SELECT * FROM productos WHERE id not in (select distinct producto_id from lineas_pedidos); ",true);
	}
	public static function getNoStockProducts(){
		return Self::getDatabaseElements("SELECT * FROM productos WHERE stock =0",true);
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
		if(Self::isIdentity() && $_SESSION['identity']->id === $id){
			return true;
		}
		header("Location:".base_url);
	}

	public static function printSQLTable($query,$header=null){

		$retorno = "<table>";
		if($header!==null){
			$retorno .="<tr>";
			foreach ($header as $key => $value) {
				$retorno .= "<td>"."$value"."</td>";
			}
			$retorno .="</tr>";
		}
		foreach($query as $key=>$value){

			$retorno .= "<tr>";
			foreach ($value as $key2 => $value2) {
				$retorno .= "<td>"."$value2"."</td>";
			}
			$retorno .="</tr>";
		}
		$retorno .= "</table>";
		return $retorno;
	}

	public static function printsStdClass($classesArray){

		if(count($classesArray)==0) return "no existen productos en esta búsqueda";
		$msg = "<table><tr>";
		foreach($classesArray[0] as $clave=>$valor){
			$msg.="<td><b>".$clave."</br></td>";
		}
		$msg.="</tr>";

		foreach($classesArray as $claveI=>$clase){
			$msg.="<tr>";
			foreach($clase as $claveJ=>$valorJ){

				if($claveJ=="imagen"){
					$msg.="<td><img src=".base_url."uploads/images/$valorJ></td>";
				}
				else{
				$msg.="<td>".$valorJ."</td>";
				}
			}
			$msg.="<td><a href=".base_url."producto/editar&id=".$clase->id." class ='button button-gestion'>editar producto</a></td>";
			$msg.="</tr>";
		}
		$msg.="</table>";
		return $msg;
	}

	public static function getBargain($cost){

		return number_format(($cost+($cost/100)*20),2);

	}
}

