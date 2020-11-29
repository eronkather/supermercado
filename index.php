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


//Trata os erros das rotas não implementadas

$router->get("/ops/{errcode}", "WebController:error", 'webcontroller.error');

$router->dispatch();

if ($router->error()) {
    
    $router->redirect("/ops/{$router->error()}");
    
}
?>

