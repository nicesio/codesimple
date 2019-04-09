<?php

use \codesimple\PageAdmin;
use \codesimple\Model\Usuario;

$app->get("/admin/usuarios", function(){
	//Usuario::verifyLogin();
	$usuario = Usuario::listAll();
	//$users = Usuario::listAll();
	$page = new PageAdmin();
	$page->setTpl("usuarios", array(
		"usuarios"=>$usuario
	));
});

$app->get("/admin/usuarios/create", function(){
	//User::verifyLogin();
	$page = new PageAdmin();
	$page->setTpl("usuarios-create");
});

$app->get("/admin/usuarios/:idusuario/delete", function($idusuario){
	//User::verifyLogin();

	$usuario = new Usuario();

	$usuario->get((int)$idusuario);

	$usuario->delete();

	header("Location: /admin/usuarios");
	exit;
});


$app->get("/admin/usuarios/:idusuario", function($idusuario){
	//User::verifyLogin();
	
	$usuario = new Usuario();

	$usuario->get((int)$idusuario);
	$page = new PageAdmin();
	$page->setTpl("usuarios-update", array(
		"usuario"=>$usuario->getValues()
	));
});



$app->post("/admin/usuarios/create", function(){
	//User::verifyLogin();

	$usuario = new Usuario();

	
	//$senhausuario = password_hash($_POST["senhausuario"], PASSWORD_DEFAULT,[
	//	"cost"=>12
	//]);

	//$usuario->setPassword($senhausuario);

	$usuario->setData($_POST);

	//$_POST["inadmin"] = (isset($_POST["inadmin"]))?1:0;


	$usuario->save();

	header("Location: /admin/usuarios");
	exit;
});

$app->post("/admin/usuarios/:idusuario", function($idusuario){
	//User::verifyLogin();

	$usuario = new Usuario();

	//$_POST["inadmin"] = (isset($_POST["inadmin"]))?1:0;


	$usuario->get((int)$idusuario);

	//$senhausuario = password_hash($_POST["senhausuario"], PASSWORD_DEFAULT,[
	//	"cost"=>12
	//]);

	//$usuario->setPassword($senhausuario);

	$usuario->setData($_POST);

	$usuario->update();

	header("Location: /admin/usuarios");
	exit;
});



?>