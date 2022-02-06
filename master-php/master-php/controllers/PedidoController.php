<?php
require_once 'models/Pedido.php';
require_once 'models/Usuario.php';
class pedidoController{

	public function hacer(){
		$user = new Usuario();
		if(isset($_SESSION['admin'])||Utils::checksNonAdminId($_SESSION['identity']->id)){
			$user       = $user->getOneUser($_SESSION['identity']->id);
			$userAdress = $user->getDireccion();
		}
		require_once 'views/pedido/hacer.php';
	}

	public function add(){
		if(isset($_SESSION['identity'])){
			$user          = new Usuario();
			$user          = $user->getOneUser($_SESSION['identity']->id);
			$defaultAdress = $user->getDireccion();

			$provincia  = isset($_POST['provincia']) ? $_POST['provincia'] : false;
			$localidad  = isset($_POST['localidad']) ? $_POST['localidad'] : false;
			$direccion  = isset($_POST['direccion']) ? $_POST['direccion'] : false;

			if(isset($_POST['defaultAdress'])){
				$provincia  = $defaultAdress->provincia;
				$localidad  = $defaultAdress->localidad;
				$direccion  = $defaultAdress->direccion;
			}

			$stats = Utils::statsCarrito();
			$coste = $stats['total'];

			if($provincia && $localidad && $direccion){
				// Guardar datos en bd
				$pedido = new Pedido();
				$pedido -> setUsuario_id  ($user->getId());
				$pedido -> setProvincia   ($provincia);
				$pedido -> setLocalidad   ($localidad);
				$pedido -> setDireccion   ($direccion);
				$pedido -> setCoste           ($coste);

				//transaccion

				$user->getDb()->begin_transaction();

				if(Utils::checkCarritoBeforeOrder()){
					$save = $pedido->save();
					// Guardar linea pedido
					$save_linea = $pedido->save_linea();

					$user->getDb()->commit();

					$user->getDb()->close();

					//fin transaccion
					if($save && $save_linea){
						$_SESSION['pedido'] = "complete";
						unset($_SESSION['carrito']);
					}
				}else{
					$user->getDb()->rollback();
					$_SESSION['pedido'] = "failed";
				}

			}else{
				$_SESSION['pedido'] = "failed";
			}

			header("Location:".base_url.'pedido/confirmado');
		}else{
			// Redigir al index
			header("Location:".base_url);
		}
	}

	public function confirmado(){
		if(isset($_SESSION['identity'])){
			$identity  = $_SESSION['identity'];
			$pedido    = new Pedido();
			$pedido   -> setUsuario_id($identity->id);

			$pedido    =  $pedido->getOneByUser();

			$pedido_productos = new Pedido();
			$productos = $pedido_productos->getProductosByPedido($pedido->id);
			//cambio
			unset($_SESSION["carrito"]);
		}
		require_once 'views/pedido/confirmado.php';
	}

	public function mis_pedidos(){
		Utils::isIdentity();
		$usuario_id = $_SESSION['identity']->id;
		$pedido     = new Pedido();

		// Sacar los pedidos del usuario
		$pedido  -> setUsuario_id($usuario_id);
		$pedidos = $pedido->getAllByUser();

		require_once 'views/pedido/mis_pedidos.php';
	}

	public function detalle(){
		Utils::isIdentity();

		if(isset($_GET['id'])){
			$id     = $_GET['id'];

			// Sacar el pedido
			$pedido = new Pedido();
			$pedido -> setId($id);
			$pedido = $pedido->getOne();

			// Sacar los poductos
			$pedido_productos = new Pedido();
			$productos = $pedido_productos->getProductosByPedido($id);

			// Sacar los detalles del usuario vinculado al pedido

			$usuario   = New Usuario();
			$idUsuario = $pedido ->usuario_id;
			$usuario   = $usuario   -> getOneUser($idUsuario);
			$review    = new Review();
			$review->id_usuario=$usuario->getId();
			$arrayReviewsPendientes = $review->getPendingReviewsByUser($_SESSION['identity']->id);

			require_once 'views/pedido/detalle.php';
		}else{
			header('Location:'.base_url.'pedido/mis_pedidos');
		}
	}

	public function gestion(){
		Utils::isAdmin();
		$gestion = true;

		$pedido  = new Pedido();
		$pedidos = $pedido->getAll();

		require_once 'views/pedido/mis_pedidos.php';
	}

	public function estado(){
		Utils::isAdmin();
		if(isset($_POST['pedido_id']) && isset($_POST['estado'])){
			// Recoger datos form
			$id     = $_POST['pedido_id'];
			$estado = $_POST['estado'];

			// Upadate del pedido
			$pedido  = new Pedido();
			$pedido -> setId($id);
			$pedido -> setEstado($estado);
			$pedido -> edit();

			header("Location:".base_url.'pedido/detalle&id='.$id);
		}else{
			header("Location:".base_url);
		}
	}

	public function generatePDF(){
		ob_clean();
		ob_start();
		$html            = "<h1>ALBARAN DE ENTREGA</h1>";
		$order           = new Pedido();
		$order->setId($_GET['order']);
		$orderSTD=$order->getOne();

		$user=new Usuario();
		$user->setId($orderSTD->usuario_id);
		$user=$user->getOne();
		$orderProducts =$order->getProductosByPedido($orderSTD->id);
		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

		$html.=Self::setPDFText($orderSTD,$user,$orderProducts);


		$pdf->AddPage();
		$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
		$pdf->Output('order.pdf', 'I');
		ob_end_flush();
	}

	private static function setPDFText($order,$user,$products){
		$msg="";
		$msg .="<table><tr><th>numero de pedido</th><th>nombre de cliente</th><th>dirección</th></tr><br>";
		$msg .="<tr><td>".$order->id."</td><td>".$user->nombre." ".$user->apellidos."</td><td>".$order->direccion."</td></tr><br>";
        $msg.="<tr><td>producto</td><td>unidades</td><td>precio unidad</td></tr><br>";
		foreach ($products as $key => $product){
                $msg.="<tr><td>".$product['nombre']."</td><td>".$product['unidades']."</td><td>".$product['precio']."</td></tr>";
		}
		$msg.="</table>";
		$msg.="<p>coste total del pedido ".$order->coste."</p>";
		$msg.="<p>".$order->fecha." ".$order->hora."</p>";

		return $msg;
	}


}