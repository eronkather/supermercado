<?php

namespace Source\Controllers;

use League\Plates\Engine;
use Source\Models\ProductType;
use Source\Models\Tax;

class ProductTypeController 
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
        $productTypes = (new ProductType())->find()->order('description')->fetch(true);
        if($productTypes){
            
            foreach($productTypes as &$productType){
                $productType->data->tax = (new Tax())->findById($productType->data->taxes_id)->data;
       
            }
        }
       
        echo $this->view->render('producttype/edit', [
            'productTypes'=> $productTypes,
            'taxes'=> (new Tax())->find()->order('description')->fetch(true)  
        ]);
        
    }

    public function store(array $data):void
    {
        
        $productTypeData = filter_var_array($data, FILTER_SANITIZE_STRING);

        if(in_array("", $productTypeData)){
            $callback["message"] = message("Informe o tipo de produto, e o imposto", "error");
            echo json_encode($callback);
            return;
        }
        if($data['id']){
            $id = filter_var($data["id"], FILTER_VALIDATE_INT);
            $productType = (new ProductType())->findById($id);
            $productType->description = $data["description"];
            $productType->taxes_id = filter_var($data["taxes_id"], FILTER_VALIDATE_INT); 
            $productType->id = $data["id"];
        } else{
            $productType = new ProductType();
            $productType->description = $data["description"];
            $productType->taxes_id = filter_var($data["taxes_id"], FILTER_VALIDATE_INT);
        }


        
        $res = $productType->save();

        $productType->tax = (new Tax())->findById($productType->taxes_id)->data;
        //var_dump($res);exit;
        if($data["id"]){
            $productType->data->tax = (new Tax())->findById($productType->data->taxes_id)->data;
            $callback["message"] = message("Tipo de produto atualizado com sucesso", "success");    
        }else{
            $callback["message"] = message("Tipo de produto cadastrado com sucesso", "success");
        }
        $callback["productType"] = $this->view->render("producttype/producttype", ["productType"=>$productType]);
        echo json_encode($callback);
    }

    

    public function delete(array $data):void
    {
        if (!$data['id']) {
            return;
        }
        $id = filter_var($data["id"], FILTER_VALIDATE_INT);
        $productType = (new ProductType())->findById($id);
        if($productType){
            $productType->destroy();
        }
        $callback["remove"] = true;
        echo json_encode($callback);
    }

}
