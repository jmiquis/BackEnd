<?php
require_once 'models/Usuario.php';

class usuarioController{

	public function registro(){
		require_once 'views/usuario/registro.php';
	}

	public function gestion(){
		$usuario   = new Usuario();

		if(isset($_SESSION['admin'])){
			$usuarios   = $usuario->getAllUsers();
		}
		elseif(Utils::isIdentity()){
			$usuarios[] = $usuario->getOneUser($_SESSION['identity']->id);
		}
		require_once 'views/usuario/gestion.php';
	}


	public function userInfoManagement(){

		$user               = new Usuario();
		$userId             = $_GET["id"];
		$user               = $user->getOneUser($userId);
		$rolesArray         = Utils::getAllRoles();
		$usuariosConPedidos = Utils::checkFreeOrdersUser();
		require_once 'views/usuario/userInfoManagement.php';
	}

	public function changeUserPassword(){

		$usuario = new Usuario();
		$usuario = $usuario -> getOneUser($_GET['id']);

		require_once 'views/usuario/changeUserPassword.php';

	}

	public function save(){
		if(isset($_POST)){

			$_SESSION['register'] = "failed";

			$nombre    = isset($_POST['nombre'   ]) ? $_POST['nombre'   ] : false;
			$apellidos = isset($_POST['apellidos']) ? $_POST['apellidos'] : false;
			$email 	   = isset($_POST['email'    ]) ? $_POST['email'    ] : false;
			$password  = isset($_POST['password' ]) ? $_POST['password' ] : false;

			if( $nombre && $apellidos && $email && $password && (!in_array($email,Utils::getAllEmails()))){
				$usuario  = new Usuario();
				$usuario -> setNombre     ($nombre   );
				$usuario -> setApellidos  ($apellidos);
				$usuario -> setEmail      ($email    );
				$usuario -> setPassword   ($password );


				$save = $usuario->save();

				if($save){

					$_SESSION['register'] = "complete";

				}
			}
		}
		header("Location:".base_url.'usuario/registro');
	}


	public function modifyUser(){
		if(isset($_POST)){

			$id        = isset($_POST['id'       ]) ? $_POST["id"       ] : false;
			$nombre    = isset($_POST['nombre'   ]) ? $_POST['nombre'   ] : false;
			$apellidos = isset($_POST['apellidos']) ? $_POST['apellidos'] : false;
			$email 	   = isset($_POST['email'    ]) ? $_POST['email'    ] : false;
			$rol       = isset($_POST["rol"      ]) ? $_POST["rol"      ] : false;
			$imagen    = null;


			// Guardar la imagen
			if(isset($_FILES['imagen']) && count($_FILES)==1){

				$_SESSION['modified'] = "unsuccesful";

				$imagen   = Utils::uploadImage('imagen');
			}

			if( $id || $nombre || $apellidos || $email &&(!in_array($email,Utils::getAllEmails()))){
				$usuario  = new Usuario();
				$usuario  = $usuario -> getOneUser($id);
				$usuario -> setNombre     ($nombre   );
				$usuario -> setApellidos  ($apellidos);
				$usuario -> setEmail      ($email    );
				if ($usuario -> getImagen() !== $imagen && $imagen!== null) $usuario -> setImagen($imagen);
				if(isset($rol)) $usuario -> setRol($rol);


				$ok = $usuario-> modifyUser();

				if($ok)$_SESSION['modified'] = "succesful";
			}
		}
		header("Location:".base_url.'usuario/userInfoManagement&id='.$id);
	}

	public function modifyPassword(){

		$_SESSION["password_change"] = "error en el cambio";

		if(isset($_POST["validar"])){

			if(!empty($_POST['oldPass']) && !empty($_POST['newPass'])){

				$oldPass = $_POST['oldPass'];
				$newPass = $_POST['newPass'];
				$usuario = NEW Usuario();
				$usuario = $usuario -> getOneUser($_POST['id']);

				if(password_verify($oldPass,$usuario->getPassword())){

					if($usuario -> modifyPassword($usuario->getId(),$newPass)){
						$_SESSION["password_change"] = "cambio realizado";
					}

				}

			}
		}
		header("Location:".base_url.'usuario/changeUserPassword&id='.$_REQUEST['id']);
	}

	public function deleteUser(){

		if(!Utils::isAdmin())return false;

		$id = $_POST['deleteId'];
		$_SESSION['UserManagementMsg'] = 'error al borrar usuario ';

		$usuario = new Usuario();
		$usuario = $usuario->getOneUser($id);

			if($usuario->deleteUser($usuario->getId())){
				$_SESSION['UserManagementMsg'] = 'usuario borrado con exito ';
			}

			header("Location:".base_url.'usuario/gestion');
	}

	public function userOrdersManagement(){
		$userOrdersQuery = [];

		if(isset($_SESSION['admin']) || (Utils::isIdentity() && Utils::checksNonAdminId($_REQUEST['id']))){

			//si el id no se envia por get desde gestion se envia por post desde un hidden
			$id          = $_REQUEST['id'];
			$user        = new Usuario();
			$user        = $user->getOneUser($id);
			$tableHeader = ["<b>nº pedido</b>","<b>numero usuario</b>","<b>dirección</b>","<b>provincia</b>","<b>localidad</b>","<b>coste pedido</b>","<b>fecha</b>","<b>hora</b>","<b>estado</b>"];

			if (isset($_POST['query'])) {
				$userOrdersQuery = $this->userOrders($user);
			}
		}
		require_once 'views/usuario/userOrdersManagement.php';
	}

	private function userOrders(Usuario $user){

		switch ($_POST['query']) {
			case 'todos los pedidos':
				return  $user->getUserOrders();
			case 'busqueda filtrada':
				$today     = getdate();
				$todayDate = $today['year']. "-".$today['mon'].    "-".$today['mday'];

				$dataArray = [];
				$dataArray['adress']    = $_POST['adress'];
				$dataArray['region']    = $_POST['region'];
				$dataArray['area']      = $_POST['area'];
				$dataArray['orderCost'] = (!empty($_POST['orderCost']))?$_POST['orderCost']:"2147483647";
				$dataArray['status']    = $_POST['status'];
				$dataArray['date']      = (!empty($_POST['date'])) ? $_POST['date']:$todayDate;

				return $user->getOrderFilteredSearch($dataArray);

		}
	}


	public function login(){
		if(isset($_POST)){
			// Identificar al usuario
			// Consulta a la base de datos
			$usuario   = new Usuario();
			$usuario  -> setEmail    ($_POST['email'   ]);
			$usuario  -> setPassword ($_POST['password']);

			$identity = $usuario->login();

			if($identity && is_object($identity)){
				$_SESSION['identity'] = $identity;

				if($identity->rol == 'admin'){
					$_SESSION['admin'] = true;
				}

			}else{
				$_SESSION['error_login'] = 'Identificación fallida !!';
			}

		}
		header("Location:".base_url);
	}



	public function logout(){
		//cambio
		session_destroy();

		header("Location:".base_url);
	}

} // fin clase