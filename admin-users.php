<?php

use \codesimple\PageAdmin;
use \codesimple\Model\User;

$app->get("/admin/usuarios", function(){
	//User::verifyLogin();
	$users = User::listAll();
	$page = new PageAdmin();
	$page->setTpl("usuarios", array(
		"usuarios"=>$usuarios
	));
});

$app->get("/admin/usuarios/create", function(){
	//User::verifyLogin();
	$page = new PageAdmin();
	$page->setTpl("usuarios-create");
});

$app->get("/admin/usuarios/:idusuario/delete", function($idusuario){
	//User::verifyLogin();

	$usuario = new User();

	$usuario->get((int)$idusuario);

	$usuario->delete();

	header("Location: /admin/usuarios");
	exit;
});


$app->get("/admin/usuarios/:idusuario", function($idusuario){
	//User::verifyLogin();
	
	$usuario = new User();

	$usuario->get((int)$idusuario);
	$page = new PageAdmin();
	$page->setTpl("usuarios-update", array(
		"usuario"=>$usuario->getValues()
	));
});



$app->post("/admin/usuarios/create", function(){
	//User::verifyLogin();

	$usuario = new User();

	//$_POST["inadmin"] = (isset($_POST["inadmin"]))?1:0;

	$usuario->setData($_POST);

	$usuario->save();

	header("Location: /admin/usuarios");
	exit;
});

$app->post("/admin/usuarios/:idusuario", function($idusuario){
	//User::verifyLogin();

	$usuario = new User();

	//$_POST["inadmin"] = (isset($_POST["inadmin"]))?1:0;

	$usuario->get((int)$idusuario);

	$usuario->setData($_POST);

	$usuario->update();

	header("Location: /admin/usuarios");
	exit;
});



?>