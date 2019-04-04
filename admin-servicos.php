<?php

use \codesimple\PageAdmin;
use \codesimple\Model\Usuario;
use \codesimple\Model\Servico;


$app->get("/admin/servicos", function(){

	//User::verifyLogin();

	$servicos = Servico::listAll();

	$page = new PageAdmin();

	$page->setTpl("servicos", [
		"servicos"=>$servicos
	]);

});



$app->get("/admin/servicos/create", function(){

	//User::verifyLogin();

	$page = new PageAdmin();

	$page->setTpl("servicos-create");

});

$app->post("/admin/servicos/create", function(){

	//User::verifyLogin();

	$servico = new Servico();

	$servico->setData($_POST);

	$servico->save();

	header("Location: /admin/servicos");
	exit;
});

$app->get("/admin/servicos/:iduser/delete", function($idservico){
	//User::verifyLogin();

	$servico = new Servico();

	$servico->get((int)$idservico);

	$servico->delete();

	header("Location: /admin/servicos");
	exit;
});


$app->get("/admin/servicos/:idservico", function($idservico){

	$servico = new Servico();

	$servico->get((int)$idservico);

	$page = new PageAdmin();

	$page->setTpl("servicos-update", [
		'servico'=>$servico->getValues()
	]);

});


$app->post("/admin/servicos/:idservico", function($idservico){

	$servico = new Servico();

	$servico->get((int)$idservico);

	$servico->setData($_POST);

	$servico->save();

	$servico->setPhoto($_FILES["file"]);

	header('Location: /admin/servicos');
	exit;

});



?>