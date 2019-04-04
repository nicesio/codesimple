<?php

namespace codesimple\Model;

use \codesimple\DB\Sql;
use \codesimple\Model;
use \codesimple\Mailer;

class Servico extends Model
{
	
	public static function listAll(){
		$sql = new Sql();
		return $sql->select("SELECT * FROM servicos ORDER BY nomeservico");
	}

	public static function checkList($list){

		foreach ($list as &$row) {
			$p = new Servico();
			$p->setData($row);
			$row = $p->getValues();

		}

		return $list;
	}



	public function save(){
		$sql = new Sql();

		$results = $sql->select("CALL sp_servicos_save(:idservico, :nomeservico, :desservico)", array(
				":idservico"=>$this->getidservico(),
				":nomeservico"=>$this->getnomeservico(),
				":desservico"=>$this->getdesservico()
		));

		$this->setData($results[0]);

		
	}

	public function get($idservico){
		$sql = new Sql();

		$results = $sql->select("SELECT * FROM servicos WHERE idservico = :idservico", 
				[':idservico'=>$idservico

		]);

		$this->setData($results[0]);
	}



	public function delete(){

	$sql = new Sql();

		$sql->query("DELETE FROM servicos WHERE idservico = :idservico", 
				[':idservico'=>$this->getidservico()

		]);	

	}

	public function checkPhoto(){
		if(file_exists(
			$_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . "res" . DIRECTORY_SEPARATOR . "site" . DIRECTORY_SEPARATOR . "img" . DIRECTORY_SEPARATOR . "servicos" . DIRECTORY_SEPARATOR . $this->getidservico() . ".jpg"
		))
		{
			$url = "/res/site/img/servicos" . $this->getidservico() . ".jpg";
		}else{
			$url = "/res/site/img/servico.jpg";
		}

		return $this->setdesphoto($url);
	}

	public function getValues(){
		
		$this->checkPhoto();

		$values = parent::getValues();

		return $values;
	}


	public function setPhoto($file){

		$extension = explode('.', $file["name"]);
		$extension = end($extension);

		switch ($extension) {
			case "jpg":
			case "jpeg":
				$image = imagecreatefromjpeg($file["tmp_name"]);
				break;
			
			case "gif":
				$image = imagecreatefromgif($file["tmp_name"]);
				break;

			case "png":
				$image = imagecreatefrompng($file["tmp_name"]);
				break;

			
		}

		$dist = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . "res" . DIRECTORY_SEPARATOR . "site" . DIRECTORY_SEPARATOR . "img" . DIRECTORY_SEPARATOR . "servicos" . DIRECTORY_SEPARATOR . $this->getidservico() . ".jpg";

		imagejpeg($image, $dist);

		imagedestroy($image);

		$this->checkPhoto();


	}

}

?>