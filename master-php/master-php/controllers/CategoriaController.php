<?php
require_once 'models/Categoria.php';
require_once 'models/Producto.php';

class categoriaController{

	public function index(){
		Utils::isAdmin();
		$categoria     = new Categoria();
		$categorias    = $categoria->getAllCategories();

		require_once 'views/categoria/index.php';
	}

	public function categoriesManagement(){
		$category = new Categoria();
		$category = $category->getOneCategory($_GET['id']);
		require_once 'views/categoria/categoriesManagement.php';
	}

	public function ver(){
		if(isset($_GET['id'])){
			$id = $_GET['id'];

			// Conseguir categoria
			$categoria = new Categoria();
			$categoria -> setId($id);
			$categoria = $categoria->getOne();

			// Conseguir productos;
			$producto  = new Producto();
			$producto -> setCategoria_id($id);
			$productos = $producto->getAllCategory();
		}

		require_once 'views/categoria/ver.php';
	}
	public function showBargains(){
		$categoria = new mysqli();
		$categoria->nombre="ofertas";
		$producto  = new Producto();
		$productos = $producto->getBargains();
		require_once 'views/categoria/ver.php';
	}

	public function crear(){
		Utils::isAdmin();
		require_once 'views/categoria/crear.php';
	}

	public function save(){
		Utils::isAdmin();
	    if(isset($_POST) && isset($_POST['nombre'])){
			// Guardar la categoria en bd
			$categoria = new Categoria();
			$categoria -> setNombre($_POST['nombre']);
			$save      = $categoria->save();
		}
		header("Location:".base_url."categoria/index");
	}

	public function modifyCategory(){
		if(isset($_POST) && isset($_POST['modify'])){
			$category = new Categoria();
			$_SESSION['category_change'] = "error en el cambio";
					if(!empty($_POST['id']) && !empty($_POST['categoryName'])){
						if($category->updateCategory($_POST['categoryName'],$_POST['id'])){
							$_SESSION['category_change'] = "cambio correcto";
						}
					}
		}
		header("Location:".base_url."categoria/index");
	}

	public function deleteCategory(){
		if(isset($_POST)){
			$category = new Categoria();
			$_SESSION['category_change'] = "error al borrar";
			$catId = $_POST['id'];
			if($category->deleteCategory($catId)){
				$_SESSION['category_change'] = "borrado ok";
				header("Location:".base_url."categoria/index");
				die();
			}
		}

	}


}