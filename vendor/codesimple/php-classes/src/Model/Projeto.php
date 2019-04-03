<?php

namespace codesimple\Model;

use \codesimple\DB\Sql;
use \codesimple\Model;
use \codesimple\Mailer;

class Projeto extends Model
{
	
	public static function listAll(){
		$sql = new Sql();
		return $sql->select("SELECT * FROM projetos ORDER BY nomeprojeto");
	}

	public function save(){
		$sql = new Sql();

		$results = $sql->select("CALL sp_projetos_save(:idprojeto, :nomeprojeto, :desprojeto)", array(
				":idprojeto"=>$this->getidprojeto(),
				":nomeprojeto"=>$this->getnomeprojeto(),
				":desprojeto"=>$this->getdesprojeto()
		));

		$this->setData($results[0]);

		Projeto::updateFile();
	}

	public function get($idprojeto){
		$sql = new Sql();

		$results = $sql->select("SELECT * FROM projetos WHERE idprojeto = :idprojeto", 
				[':idprojeto'=>$idprojeto

		]);

		$this->setData($results[0]);
	}



	public function delete(){

	$sql = new Sql();

		$sql->query("DELETE FROM projetos WHERE idprojeto = :idprojeto", 
				[':idprojeto'=>$this->getidprojeto()

		]);	

		Projeto::updateFile();
	}


	public static function updateFile(){
		$projetos = Projeto::listAll();

		$html = [];

		foreach ($projetos as $row){
			array_push($html, '<li><a href="/projetos/'.$row['idprojeto'].'">'.$row['nomeprojeto'].$row['desprojeto'].'</a></li>');
		}

		file_put_contents($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . "views" . DIRECTORY_SEPARATOR . "projetos-menu.html", implode('', $html));

	}


}

?>