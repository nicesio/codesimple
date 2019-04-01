<?php

/*use \codesimple\Page;
//use \codesimple\Model\Product;

$app->get('/', function() {
    
    //$products = Product::listALL();

	$page = new Page();

	$page->setTpl("index");//'products'=>Product::checkList($products)]);

});
*/

use \codesimple\Page;

$app->get('/', function(){

	$page = new Page();

	$page->setTpl("index");

});


?>