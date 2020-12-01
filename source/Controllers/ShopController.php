<?php

namespace Source\Controllers;

use League\Plates\Engine;
use Source\Models\Product;

class ShopController 
{
    private $view;

    public function __construct($router)
    {
        
        $this->view = Engine::create(
            dirname(__DIR__, 2) . "/theme",
            "php"
        );    
   
        $this->view->addData(["router" => $router]);

        
    }

    public function checkout(array $data):void
    {
        
        if ($data){
            $products = [];
            foreach($data['product'] as $produto){
                $product = (new Product())->findById($produto['id']);
                $cartController = new CartController($product);
                $product->totalProductValue = $cartController->getTotalProcuctValue($produto['amount']);
                $product->totalTax = $cartController->getTotalTax($produto['amount']);
                $product->totalShop = $cartController->getTotalShop($produto['amount']);
                $products[] = $product;
            }
            $totalShopAmount = $cartController->getTotalShopAmount($products);
            $totalTaxAmount = $cartController->getTotalTaxAmount($products);
            
        }
        

        echo $this->view->render('shop/checkout', [
            'products'=> $products,
            'totalShopAmount' => $totalShopAmount,
            'totalTaxAmount' => $totalTaxAmount  
        ]);
    }

    public function home() :void
    {

        echo $this->view->render('shop/edit', [
            'products'=> (new Product())->find()->order('description')->fetch(true)  
        ]);
        
    }

    public function getTotalShop(): int
    {
        return 8;
    }

    

    

    

}
