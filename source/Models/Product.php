<?php
namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;

class Product extends DataLayer
{
    public function __construct(){
        parent::__construct("products", ["product_type_id","description", "price"], "id", true);
    }

    public function productType()
    {
        return (new ProductType())->findById($this->product_type_id); 
    }
}

