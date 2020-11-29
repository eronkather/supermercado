<?php

class TaxController
{
    public function __construct()
    {
        
    }

    public function error(array $data):void
    {
        echo "<h1>Erro {$data["errCode"]}</h1>";
    }
}


?>