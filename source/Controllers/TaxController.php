<?php

namespace Source\Controllers;

use League\Plates\Engine;
use Source\Models\Tax;

class TaxController 
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

        echo $this->view->render('tax/edit', [
            'taxes'=> (new Tax())->find()->order('description')->fetch(true)  
        ]);
        
    }

    public function store(array $data):void
    {
        
        $taxData = filter_var_array($data, FILTER_SANITIZE_STRING);

        if(in_array("", $taxData)){
            $callback["message"] = message("Informe a descrição do imposto e a porcentagem", "error");
            echo json_encode($callback);
            return;
        }
        if($data['id']){
            $id = filter_var($data["id"], FILTER_VALIDATE_INT);
            $tax = (new Tax())->findById($id);
            $tax->description = $data["description"];
            $tax->percentage = $data["percentage"];
            $tax->id = $data["id"];
        } else{
            $tax = new Tax();
            $tax->description = $data["description"];
            $tax->percentage = $data["percentage"];
        }
        
        $tax->save();

        if($data["id"]){
            $callback["message"] = message("Imposto atualizado com sucesso", "success");    
        }else{
            $callback["message"] = message("Imposto cadastrado com sucesso", "success");
        }
        $callback["tax"] = $this->view->render("tax/tax", ["tax"=>$tax]);
        echo json_encode($callback);
    }

    

    public function delete(array $data):void
    {
        if (!$data['id']) {
            return;
        }
        $id = filter_var($data["id"], FILTER_VALIDATE_INT);
        $tax = (new Tax())->findById($id);
        if($tax){
            $tax->destroy();
        }
        $callback["remove"] = true;
        echo json_encode($callback);
    }

}
