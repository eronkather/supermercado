<?php
namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;

class Tax extends DataLayer
{
    public function __construct(){
        parent::__construct("taxes", ["description","percentage"]);
    }

    
}

