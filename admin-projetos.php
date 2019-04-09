<?php

use \codesimple\Page;
use \codesimple\PageAdmin;
use \codesimple\Model\Usuario;
use \codesimple\Model\Projeto;

$app->get("/admin/projetos", function(){

	Usuario::verifyLogin();
	$projetos = Projeto::listAll();

	$page = new PageAdmin();

	$page->setTpl("projetos", [
		'projetos'=>$projetos
	]);
});

$app->get("/admin/projetos/create", function(){
	Usuario::verifyLogin();
	$page = new PageAdmin();

	$page->setTpl("projetos-create");
});

$app->post("/admin/projetos/create", function(){
	Usuario::verifyLogin();

	$projeto = new Projeto();

	$projeto->setData($_POST);

	$projeto->save();

	header('Location: /admin/projetos');
	exit;

});


$app->get("/admin/projetos/:idprojeto/delete", function($idprojeto){
	Usuario::verifyLogin();
	$projeto = new Projeto();

	$projeto->get((int)$idprojeto);

	$projeto->delete();

	header('Location: /admin/projetos');
	exit;

});


$app->get("/admin/projetos/:idprojeto", function($idprojeto){
	Usuario::verifyLogin();
	$projeto = new Projeto();

	$projeto->get((int)$idprojeto);

	$page = new PageAdmin();

	$page->setTpl("projetos-update", [
		'projeto'=>$projeto->getValues()
	]);

});


$app->post("/admin/projetos/:idprojeto", function($idprojeto){
	Usuario::verifyLogin();
	$projeto = new Projeto();

	$projeto->get((int)$idprojeto);

	$projeto->setData($_POST);

	$projeto->save();

	header('Location: /admin/projetos');
	exit;

});

$app->get("/projetos/:idprojeto", function($idprojeto){
	
	Usuario::verifyLogin();
	$projeto = new Projeto();
	
	$projeto->get((int)$idprojeto);

	$page = new Page();

	$page->setTpl("projeto", 
		['projeto'=>$projeto->getValues(),
		 'servico'=>[]
	]);
});





?>