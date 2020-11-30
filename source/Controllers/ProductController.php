<?php

namespace Source\Controllers;

use League\Plates\Engine;
use Source\Models\Product;
use Source\Models\ProductType;


class ProductController 
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

    public function home() :void
    {
        $products = (new Product())->find()->order('description')->fetch(true);
        if($products){
            
            foreach($products as &$product){
                $product->data->productType = (new ProductType())->findById($product->data->product_type_id)->data;      
            }
        }
       
        echo $this->view->render('product/edit', [
            'products'=> $products,
            'producttypes'=> (new ProductType())->find()->order('description')->fetch(true)  
        ]);
        
    }

    public function store(array $data):void
    {
        
        $productData = filter_var_array($data, FILTER_SANITIZE_STRING);

        if(in_array("", $productData)){
            $callback["message"] = message("Informe o nome do produto e o tipo", "error");
            echo json_encode($callback);
            return;
        }
        if($data['id']){
            $id = filter_var($data["id"], FILTER_VALIDATE_INT);
            $product = (new Product())->findById($id);
            $product->description = $data["description"];
            $product->product_type_id = filter_var($data["product_type_id"], FILTER_VALIDATE_INT); 
            $product->id = $data["id"];
        } else{
            $product = new Product();
            $product->description = $data["description"];
            $product->product_type_id = filter_var($data["product_type_id"], FILTER_VALIDATE_INT);
        }

        $product->save();

        $product->productType = (new ProductType())->findById($product->product_type_id)->data;
        //var_dump($res);exit;
        if($data["id"]){
            $product->data->productType = (new ProductType())->findById($product->data->product_type_id)->data;
            $callback["message"] = message("Produto atualizado com sucesso", "success");    
        }else{
            $callback["message"] = message("Produto cadastrado com sucesso", "success");
        }
        $callback["product"] = $this->view->render("product/product", ["product"=>$product]);
        echo json_encode($callback);
    }

    

    public function delete(array $data):void
    {
        if (!$data['id']) {
            return;
        }
        $id = filter_var($data["id"], FILTER_VALIDATE_INT);
        $productType = (new Product())->findById($id);
        if($productType){
            $productType->destroy();
        }
        $callback["remove"] = true;
        echo json_encode($callback);
    }

}
