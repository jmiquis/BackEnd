<?php
require_once 'models/Producto.php';
require_once 'models/Usuario.php';
require_once 'helpers/direccion_habitual.php';
require_once 'vendor/autoload.php';

class productoController{

	public function index(){
		$producto = new Producto();
		$productos = $producto->getRandom(6);

		// renderizar vista
		require_once 'views/producto/destacados.php';
	}

	public function ver(){
		if(isset($_GET['id'])){

			$id       = $_GET['id'];

			$producto = new Producto();
			$producto -> setId($id);
			$product    = $producto->getOne();
			$review = new Review();
			$review->id_producto = $product->id;

		}
		require_once 'views/producto/ver.php';
	}

	public function gestion(){
		Utils::isAdmin();
		$producto             = new Producto();
		$numeroProductosTotal = $producto->getTotalNumberOfProducts();
		if(!isset($_GET['pagina']))$_GET['pagina'] = 1;
		$productos            = $producto->getAllPaginated($_GET['pagina'],$numeroProductosTotal);


		require_once 'views/producto/gestion.php';
	}

	public function crear(){
		Utils::isAdmin();
		require_once 'views/producto/crear.php';
	}

	public function salesManagement(){
		Utils::isAdmin();
		$mostSold    = Utils::getMostSoldProduct();
		$notSold     = Utils::getNotSoldProducts();
		$noStockProd = Utils::getNoStockProducts();

		require_once 'views/producto/salesManagement.php';
	}

	public function save(){
		Utils::isAdmin();
		if(isset($_POST)){
			$nombre      = isset($_POST['nombre'])                           ? $_POST['nombre']      : false;
			$descripcion = isset($_POST['descripcion'])                      ? $_POST['descripcion'] : false;
			$precio      = (isset($_POST['precio']) && $_POST['precio']>0 )  ? $_POST['precio']      : false;
			$stock       = (isset($_POST['stock']) && $_POST['stock']>0)     ? $_POST['stock']       : false;
			$categoria   = isset($_POST['categoria'])                        ? $_POST['categoria']   : false;
			$imagen      = isset($_POST['imagen'     ])                      ? $_POST['imagen']      : false;

			if($nombre && $descripcion && $precio && $stock && $categoria){
				$producto = new Producto();
				$producto -> setNombre($nombre);
				$producto -> setDescripcion($descripcion);
				$producto -> setPrecio($precio);
				$producto -> setStock($stock);
				$producto -> setCategoria_id($categoria);

				// Guardar la imagen
				if(isset($_FILES['imagen'])){
					$file     = $_FILES['imagen'];
					$filename = $file['name'];
					$mimetype = $file['type'];

					if($mimetype == "image/jpg" || $mimetype == 'image/jpeg' || $mimetype == 'image/png' || $mimetype == 'image/gif'){

						if(!is_dir('uploads/images')){
							mkdir('uploads/images', 0777, true);
						}

						$producto->setImagen($filename);
						move_uploaded_file($file['tmp_name'], 'uploads/images/'.$filename);
					}
				}

				if(isset($_GET['id'])){
					$id   = $_GET['id'];
					$producto->setId($id);

					$save = $producto->edit();
				}else{
					$save = $producto->save();
				}

				if($save){
					$_SESSION['producto'] = "complete";
				}else{
					$_SESSION['producto'] = "failed";
				}
			}else{
				$_SESSION['producto'] = "failed";
			}
		}else{
			$_SESSION['producto'] = "failed";
		}
		header('Location:'.base_url.'Producto/gestion');
	}

	public function editar(){
		Utils::isAdmin();
		if(isset($_GET['id'])){

			$id       = $_GET['id'];
			$edit     = true;
			$producto = new Producto();
			$pro      = $producto->getOneProduct($id);
			$cat      = new Categoria();

			require_once 'views/producto/editar.php';

		}else{
			header('Location:'.base_url.'Producto/gestion');
		}
	}

	public function modifyProduct(){
		$_SESSION['change_product'] = "error en el cambio";
		Utils::isAdmin();
		$name            = isset($_POST['productName'])                   ? $_POST['productName'] : false;
		$category_id     = isset($_POST['category'])                      ? $_POST['category']    : false;
		$cost            = (isset($_POST['cost']) && $_POST['cost']>0 )   ? $_POST['cost']      : false;
		$stock           = (isset($_POST['stock']) && $_POST['stock']>0)  ? $_POST['stock']       : false;
		$deal            = isset($_POST['deal'])                          ? $_POST['deal'    ]    : false;
		$description     = isset($_POST['description'])                   ? $_POST['description'] : $name;
		$image    = false;

		if(isset($_FILES['image']) && count($_FILES)==1){
			$image   = Utils::uploadImage('image');
		}

		if($name && $category_id && $cost && $cost && $deal){
			$auxProduct = new Producto();
			$auxProduct = $auxProduct->getOneProduct($_POST['id']);
			$auxProduct->setNombre($name);
			$auxProduct->setCategoria_id($category_id);
			$auxProduct->setPrecio($cost);
			$auxProduct->setStock($stock);
			$auxProduct->setOferta($deal);
			$auxProduct->setDescripcion($description);
			if($image == false) $image = $auxProduct->getImagen();
			$auxProduct->setImagen($image);
			if($auxProduct->edit()){
				$_SESSION['producto'] = "complete";
				header("Location:".base_url.'producto/gestion');
				return;
			}
		header("Location:".base_url.'producto/editar&id='.$_REQUEST['id']);
		}
	}

	public function eliminar(){
		Utils::isAdmin();

		if(isset($_GET['id'])){
			$id       = $_GET['id'];
			$producto = new Producto();
			$producto -> setId($id);

			$delete   = $producto->delete();

			if($delete){
				$_SESSION['delete'] = 'complete';
			}else{
				$_SESSION['delete'] = 'failed';
			}
		}else{
			$_SESSION['delete'] = 'failed';
		}

		header('Location:'.base_url.'Producto/gestion');
	}

	public function updateReview(){

		if(isset($_POST['accion'])){
			if ($this->checkReview()) {
				$review = new Review();
				$review->id_usuario  = $_POST['usuarioId'];
				$review->id_producto = $_POST['productoId'];
				$review->review      = $_POST['reviewProducto'];
				$review->nota        = $_POST['notaReview'];

				if($review->updateReview()){
					header("Location:".base_url."pedido/detalle&id=".$_POST['pedidoId']);
					die();
				}
			$_SESSION['change_review'] = "No se ha podido añadir la review. Algo no ha ido bien";
			echo(HISTORYBACK);
			}
		}
	}
	private function checkReview(){
		return !empty($_POST['notaReview'])&& !empty($_POST['reviewProducto']) && $_POST['notaReview']>0 && $_POST['notaReview']<=10;
	}

}