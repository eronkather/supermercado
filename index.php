<?php

use CoffeeCode\Router\Router;

require __DIR__ . "/vendor/autoload.php";


$router = new Router(ROOT);

$router->namespace("source\Controllers");

//Rotas dos Impostos
$router->get("/", "TaxController:home", "taxcontroller.home");
$router->get("/taxes", "TaxController:home", "taxcontroller.home");
$router->post("/taxes/store", "TaxController:store", "taxcontroller.store");
$router->delete("/taxes/delete", "TaxController:delete", "taxcontroller.delete");
$router->patch("/taxes/store", "TaxController:store", "taxcontroller.store");

//Rotas dos Tipos de Produtos
$router->get("/producttypes", "ProductTypeController:home", "producttypecontroller.home");
$router->post("/producttypes/store", "ProductTypeController:store", "producttypecontroller.store");
$router->delete("/producttypes/delete", "ProductTypeController:delete", "producttypecontroller.delete");
$router->patch("/producttypes/store", "ProductTypeController:store", "producttypecontroller.store");

//Rotas dos Produtos
$router->get("/products", "ProductController:home", "productcontroller.home");
$router->post("/products/store", "ProductController:store", "productcontroller.store");
$router->delete("/products/delete", "ProductController:delete", "productcontroller.delete");
$router->patch("/products/store", "ProductController:store", "productcontroller.store");

//Trata os erros das rotas não implementadas
$router->get("/ops/{errcode}", "WebController:error", 'webcontroller.error');
$router->dispatch();

if ($router->error()) {
    $router->redirect("/ops/{$router->error()}");
}
?>

