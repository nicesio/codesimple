<?php

namespace codesimple\Model;

use \codesimple\DB\Sql;
use \codesimple\Model;
//use \codesimple\Mailer;

class Usuario extends Model
{
	const SESSION="Usuario";
	//const SECRET = "codesimple7_Secret";

	/*public static function login($nomeusuario, $senhausuario){
		$sql = new Sql;
		$results = $sql->select("SELECT * FROM usuarios WHERE nomeusuario = :nomeusuario", array(":nomeusuario"=>$nomeusuario));
		//$senhahash = $sql->select("SELECT * FROM usuarios WHERE senhausuario = :senhausuario",[
		//	":senhausuario"=>password_hash($senhausuario, PASSWORD_DEFAULT)
		//]);
		if (count ($results) === 0){
			throw new \Exception("Usuario Inexistente ou senha invalida.");
			
		}

		$data = $results[0];

		if (password_verify($senhausuario, $data["senhausuario"])===true){
			$usuario = new Usuario();

			$usuario->setData($data["idusuario"]);

			$_SESSION[Usuario::SESSION] = $usuario->getValues();

			return $usuario;

		}else{
			throw new \Exception("Usuario inexistente ou senha invalida");
			
		}
	}*/

	public static function login($usuario, $senhausuario){

		$usuario = $_POST["usuario"];
		$senhausuario = $_POST["senhausuario"];

		$sql = new Sql();

		$results = query("SELECT * FROM usuarios WHERE 'nomeusuario' = '$usuario' AND 'senhausuario' = '$senhausuario'");

		if(mysql_num_rows ($results) > 0 )
		{
				$_SESSION['usuario'] = $usuario;
				$_SESSION['senhausuario'] = $senhausuario;
				//header('location:site.php');
		}
		else
		{
  				unset ($_SESSION['usuario']);
  				unset ($_SESSION['senhausuario']);
  				//header('location:index.php');
  		}
	}
	




	public static function verifyLogin(){
		if(
			!isset($_SESSION[Usuario::SESSION])
			||
			!$_SESSION[Usuario::SESSION]
			||
			!(int)$_SESSION[Usuario::SESSION]["idusuario"] > 0
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

		$sql->query("UPDATE tb_usuarios SET senhausuario = :senhausuario WHERE idusuario = :idusuario", array(
				":senhausuario"=>$senhausuario,
				":idusuario"=>$this->getidusuario()
		));
	}

}

?>