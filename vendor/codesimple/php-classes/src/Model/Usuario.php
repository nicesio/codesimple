<?php

namespace codesimple\Model;

use \codesimple\DB\Sql;
use \codesimple\Model;
//use \codesimple\Mailer;

class Usuario extends Model
{
	const SESSION="Usuario";
	//const SECRET = "codesimple7_Secret";
	
	/*public static function login($usuario, $senhausuario){
		$sql = new Sql;
		$results = $sql->select("SELECT * FROM usuarios WHERE nomeusuario = :NOMEUSUARIO", array(":NOMEUSUARIO"=>$usuario));

		if (count ($results) === 0){
			throw new \Exception("Usuario Inexistente ou senha invalida.");
			
		}

		$data = $results[0];



		if (password_verify($senhausuario, $data["senhausuario"])===true){
			$usuario = new Usuario();

			$user->setData($data["idusuario"]);

			$_SESSION[Usuario::SESSION] = $usuario->getValues();

			return $usuario;

		}else{
			throw new \Exception("Usuario inexistente ou senha invalida");
			
		}
	}*/

	public static function login($nomeusuario, $senhausuario){
		$sql = new Sql();

		if (empty($_POST['usuario'])||empty($_POST['senhausuario'])){
			header('Location: /admin/login');
		}

		//$usuario = mysqli_real_escape_string($sql, $_POST['usuario']);
		//$senhausuario = mysqli_real_escape_string($sql, $_POST['senhausuario']);

		$results = $sql->select("SELECT * FROM usuarios WHERE nomeusuario = '{$nomeusuario}' AND senhausuario = md5('{$senhausuario}')");

		//$results = ($query);

		//$row = ($results);



		if (count ($results) === 0){
			throw new \Exception("Usuario Inexistente ou senha invalida.");
		}  

		$data = $results[0];
		
		if ($results ===1){

			$usuario = new Usuario();

			$usuario->setData($data["idusuario"]);

			$_SESSION[Usuario::SESSION] = $usuario->getValues();
			return $usuario;
		}
		else{
			header('Location: /admin/login');	
		}


	}

	public static function verifyLogin($idusuario = true){
		if(
			isset($_SESSION[Usuario::SESSION])
			||
			$_SESSION[Usuario::SESSION]
			||
			(int)$_SESSION[Usuario::SESSION]["idusuario"] > 0
			//(bool)$_SESSION[User::SESSION]["inadmin"]!==$inadmin
		){
			header("Location: /admin/login");
			exit;
		}
	}


	public static function logout()
	{
		$_SESSION[Usuario::SESSION]=NULL;
	}

	public static function listAll(){
		$sql = new Sql();
		return $sql->select("SELECT * FROM usuarios ORDER BY idusuario");
	}

	public function save(){
		$sql = new Sql();

		$results = $sql->select("CALL sp_users_save(:idusuario, :nomeusuario, :senhausuario, :emailusuario)", array (
			":idusuario"=>$this->getidusuario(),
			":nomeusuario"=>$this->getnomeusuario(),
			":senhausuario"=>$this->getsenhausuario(),
			":emailusuario"=>$this->getemailusuario()
		));

		//$senhausuario = password_hash("rasmuslerdorf", PASSWORD_DEFAULT);

		$this->setData($results[0]);
		
				
	}


	public function get($idusuario){

		$sql = new Sql();

		$results = $sql->select("SELECT * FROM usuarios WHERE idusuario = :idusuario", array(
			":idusuario"=>$idusuario
		));

		//$data($results[0]);

		$this->setData($results[0]);
	}


	public function update(){
		$sql = new Sql();

		$results = $sql->select("CALL sp_usersupdate_save(:idusuario, :nomeusuario, :senhausuario, :emailusuario)", array (
			":idusuario"=>$this->getidusuario(),
			":nomeusuario"=>$this->getnomeusuario(),
			":senhausuario"=>$this->getsenhausuario(),
			":emailusuario"=>$this->getemailusuario()
	));

		$this->setData($results[0]);

	}



	public function delete(){

		$sql = new Sql();

		$sql->query("DELETE FROM usuarios WHERE idusuario = :idusuario", [
			":idusuario"=>$this->getidusuario()
		]);

	}



	public function setPassword($senhausuario){
		$sql = new Sql();

		$sql->query("UPDATE usuarios SET senhausuario = :senhausuario WHERE idusuario = :idusuario", array(
				":senhausuario"=>$senhausuario,
				":idusuario"=>$this->getidusuario()
		));
	}

}

?>