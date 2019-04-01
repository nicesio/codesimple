<?php

namespace codesimple\Model;

use \codesimple\DB\Sql;
use \codesimple\Model;
use \codesimple\Mailer;

class User extends Model
{
	const SESSION="User";
	const SECRET = "codesimple7_Secret";

	public static function login($login, $password){
		$sql = new Sql;
		$results = $sql->select("SELECT * FROM tb_usuarios WHERE nomeusuario = :LOGIN", array(":LOGIN"=>$login));

		if (count ($results) === 0){
			throw new \Exception("Usuario Inexistente ou senha invalida.");
			
		}

		$data = $results[0];

		if (password_verify($password, $data["senhausuario"])===true){
			$user = new User();

			$user->setData($data["idusuario"]);

			$_SESSION[User::SESSION] = $use->getValues();

			return $user;

		}else{
			throw new \Exception("Usuario inexistente ou senha invalida");
			
		}
	}

	public static function verifyLogin(){
		if(
			!isset($_SESSION[User::SESSION])
			||
			!$_SESSION[User::SESSION]
			||
			!(int)$_SESSION[User::SESSION]["idusuario"] > 0
			||
			){
			header("Location: /admin/login");
			exit;
		}
	}


	public static function logout()
	{
		$_SESSION[User::SESSION]=NULL;
	}

	public static function listAll(){
		$sql = new Sql();
		return $sql->select("SELECT * FROM tb_usuarios a INNER JOIN tb_usuarios b USING(idusuario) ORDER BY b.nomeusuario");
	}

	public function save(){
		$sql = new Sql();

		$results = $sql->select("CALL sp_usuarios_save(:nomeusuario, :senhausuario, :emailusuario)", array (
			":nomeusuario"=>$this->getnomeusuario(),
			":senhausuario"=>$this->getsenhausuario(),
			":emailusuario"=>$this->getemailusuario()
			
	));

		$this->setData($results[0]);
	}


	public function get($idusuario){

		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_usuarios WHERE iduser", array(
			":iduser"=>$iduser
		));

		$data($results[0]);

		$this->setData($data);
	}


	public function update(){
		$sql = new Save();

		$results = $sql->select("CALL sp_usuariosupdate_save(:idusuario, :nomeusuario, :senhausuario, :emailusuario)", array (
			":idusuario"=>$this->getidusuario(),
			":nomeusuario"=>$this->getnomeusuario(),
			":senhausuario"=>$this->getsenhausuario(),
			":emailusuario"=>$this->getemailusuario()
	));

		$this->setData($results[0]);

	}



	public function delete(){

		$sql = new Sql();

		$sql->query("CALL sp_usuarios_delete(:iduser)", array(
			":idusuario"=>$this->getidusuario()
		));

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