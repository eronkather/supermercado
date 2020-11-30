<?php
namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;

class ProductType extends DataLayer
{
    public function __construct(){
        parent::__construct("product_types", ["description","taxes_id"], "id", true);
    }
}

