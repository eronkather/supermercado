<?php

use CoffeeCode\Router\Router;

require __DIR__ . "/vendor/autoload.php";


$router = new Router(ROOT);

$router->namespace("source\Controllers");

//Rotas dos Impostos
$router->get("/", "TaxController:home", "taxcontroller.home");
$router->post("/store", "TaxController:store", "taxcontroller.store");
$router->delete("/delete", "TaxController:delete", "taxcontroller.delete");
$router->patch("/store", "TaxController:store", "taxcontroller.store");

//print_r($router);exit;

$router->dispatch();

if ($router->error()) {
    var_dump($router->error());
}
?>

