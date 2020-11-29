<?php
namespace Source\Controllers;
use League\Plates\Engine;

class WebController
{
    private $view;
    public function __construct()
    {
        $this->view = Engine::create(
            dirname(__DIR__, 2) . "/theme",
            "php"
        );    
   
 
    }

    public function error(array $data):void
    {
        
        echo $this->view->render('error/error', [
            "title"=>"Error {$data['errcode']}",
            "error"=> $data["errcode"]  
        ]);
    }
}


?>