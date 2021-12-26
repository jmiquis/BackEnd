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
	//modificado para que devuelva la contraseña encriptada de la base de datos
	function getPassword() {
		return $this->password;
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
		$sql = "INSERT INTO usuarios VALUES(NULL, '{$this->getNombre()}', '{$this->getApellidos()}', '{$this->getEmail()}', '{$this->getPassword()}', 'user', 'standardUser.jpg');";
		$save = $this->db->query($sql);

		$result = false;
		if($save){
			$result = true;
		}
		return $result;
	}

	//UPDATE
	//añadido para funcionalidad 1->Jorge
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

	//Añadida para funcionalidad 1 por Jorge

	public function getAllUsers():mysqli_result{

		$users = $this->db->query("SELECT * FROM usuarios ORDER BY rol, id DESC");

		return $users;
	}

	//añadido para funcionalidad 1->Jorge
	public function getOneUser(int $userId):Usuario{

		$user = $this->db->query("SELECT * FROM usuarios WHERE id = $userId");

		$user = $user->fetch_object("Usuario");
		return $user;

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

		$encriptedPassword = $this->db->real_escape_string($encriptedPassword);

		$stm = $this->db->prepare("UPDATE usuarios SET password=? WHERE id=?");
		if($stm == false) return false;

		$stm -> bind_param("si",$encPass,$id);
		$stm -> execute();

		return ($this->db->affected_rows  == 1) ? true : false;

	}


}