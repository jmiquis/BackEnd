<?php



class Usuario{
	private $id;
	private $nombre;
	private $apellidos;
	private $email;
	private $password;
	private $rol;
	private $imagen;
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

	function getApellidos() {
		return $this->apellidos;
	}

	function getEmail() {
		return $this->email;
	}

	function getPassword() {
		return $this->password;
	}

	function getEncryptedPassword(){
		return password_hash($this->db->real_escape_string($this->password), PASSWORD_BCRYPT, ['cost' => 4]);
	}

	function getRol() {
		return $this->rol;
	}

	function getImagen() {
		return $this->imagen;
	}

	function setId($id) {
		$this->id = $id;
	}

	function setNombre($nombre) {
		$this->nombre = $this->db->real_escape_string($nombre);
	}

	function setApellidos($apellidos) {
		$this->apellidos = $this->db->real_escape_string($apellidos);
	}

	function setEmail($email) {
		$this->email = $this->db->real_escape_string($email);
	}

	function setPassword($password) {
		$this->password = $password;
	}

	function setRol($rol) {
		$this->rol = $rol;
	}

	function setImagen($imagen) {
		$this->imagen = $imagen;
	}



  //INSERT
	public function save(){
		$sql = "INSERT INTO usuarios VALUES(NULL, '{$this->getNombre()}', '{$this->getApellidos()}', '{$this->getEmail()}', '{$this->getEncryptedPassword()}', 'user', 'standardUser.jpg');";
		$save = $this->db->query($sql);

		$result = false;
		if($save){
			$result = true;
		}
		return $result;
	}

	//UPDATE

	public function modifyUser():bool{

		$nombre    = $this -> getNombre();
		$apellidos = $this -> getApellidos();
		$rol       = $this -> getRol();
		$imagen    = $this -> getImagen();
		$id        = $this -> getId();
		$email     = $this -> getEmail();


		$statementModUser  = $this->db->prepare("UPDATE usuarios SET nombre=?,apellidos=?,email=?,rol=?, imagen=? WHERE id=?");
		if(!$statementModUser) return false;
		$statementModUser -> bind_param("sssssi",$nombre,$apellidos,$email,$rol,$imagen,$id);
		$statementModUser -> execute();

		return ($this->db->affected_rows  == 1) ? true : false;
	}

	//DELETE

	public function deleteUser($id){

		$statementDeleteUser = $this->db->prepare("DELETE FROM usuarios WHERE id=?");
		if(!$statementDeleteUser)return false;
		$statementDeleteUser->bind_param("i",$id);
		$statementDeleteUser->execute();
		$execution = $statementDeleteUser->affected_rows;

		switch($execution){
			case 1:
				return true;

			case -1:
				$_SESSION['UserManagementMsg'] = $statementDeleteUser->error;
				return false;
		}

	}





	public function getAllUsers(){

		$usersArray = [];
		$users      = $this->db->query("SELECT * FROM usuarios ORDER BY rol, id DESC");
		while($row = $users->fetch_object("Usuario"))$usersArray[] = $row;


		return $usersArray;
	}

	public function getOneUser(int $userId):Usuario{

		$user = $this->db->query("SELECT * FROM usuarios WHERE id = $userId");

		$user = $user->fetch_object("Usuario");
		return $user;

	}

		//rellenan los selectores para la busqueda filtrada
	private function getDatabaseElementsByUser(String $statement){
		$elementsArray    = [];
		$id               = $this->getId();
		$genericStatement = $this->db->prepare("$statement");
		if(!$genericStatement) return false;

		$genericStatement->bind_param("i",$id);
		if(!$genericStatement->execute()) return false;

		$getAllResults = $genericStatement->get_result();
		while($row = $getAllResults->fetch_array(MYSQLI_NUM))$elementsArray[] = $row;

		return $elementsArray;
	}

	public function getUserOrders()          {return $this->getDatabaseElementsByUser("SELECT *                  FROM pedidos WHERE usuario_id=?");}
	public function getUserAdresses()        {return $this->getDatabaseElementsByUser("SELECT DISTINCT direccion FROM pedidos WHERE usuario_id=?");}
	public function getUserRegions()         {return $this->getDatabaseElementsByUser("SELECT DISTINCT provincia FROM pedidos WHERE usuario_id=?");}
	public function getUserAreas()           {return $this->getDatabaseElementsByUser("SELECT DISTINCT localidad FROM pedidos WHERE usuario_id=?");}
	public function getUserOrdersStatus()    {return $this->getDatabaseElementsByUser("SELECT DISTINCT estado    FROM pedidos WHERE usuario_id=?");}

	//busqueda filtrada
	public function getOrderFilteredSearch($dataArray){
		$ordersArray = [];
		$id    =  $this->getId();
		$query = "SELECT * FROM pedidos WHERE direccion LIKE ? AND provincia LIKE ? AND localidad LIKE ? AND coste <= ? AND estado LIKE ? AND datediff(?,fecha)>=0 AND usuario_id=?";
		$preparedStatement = $this->db->prepare($query);
		if(!$preparedStatement) return false;
		$preparedStatement->bind_param("sssissi",$dataArray['adress'],$dataArray['region'],$dataArray['area'],$dataArray['orderCost'],$dataArray['status'],$dataArray['date'],$id);
		if(!$preparedStatement->execute()) return false;
		$getOrders = $preparedStatement->get_result();
		while($row = $getOrders->fetch_array(MYSQLI_NUM))$ordersArray[] = $row;
		return $ordersArray;
	}






	public function login(){
		$result   = false;
		$email    = $this -> email;
		$password = $this -> password;

		// Comprobar si existe el usuario
		$sql = "SELECT * FROM usuarios WHERE email = '$email'";
		$login = $this->db->query($sql);


		if($login && $login->num_rows == 1){
			$usuario = $login->fetch_object();

			// Verificar la contraseña
			$verify  = password_verify($password, $usuario->password);

			if($verify){
				$result = $usuario;
			}
		}

		return $result;
	}

	//sube la contraseña encriptada a la base de datos
	public function modifyPassword($id,$password){

		$encriptedPassword = password_hash($password,PASSWORD_BCRYPT,['cost' => 4]);

		$stm = $this->db->prepare("UPDATE usuarios SET password=? WHERE id=?");
		if($stm == false) return false;

		$stm -> bind_param("si",$encriptedPassword,$id);
		$stm -> execute();

		return ($this->db->affected_rows  == 1) ? true : false;

	}


}