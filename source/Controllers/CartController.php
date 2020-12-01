<?php

namespace Source\Controllers;
use Source\Models\Product;

class CartController 
{
    private $price;
    private $percentage;
    private $productType;
    private $tax;


    public function __construct(Product $product)
    {
        $this->productType = $product->productType();
        $this->tax = $this->productType->tax();
        $this->price = $product->price;
        $this->percentage = $this->tax->percentage;
    }

    function getTotalProcuctValue(int $amount) : int
    {
        return $this->price * $amount;
    }


    function getTotalShopAmount(array $itens) : int
    {
        $total = 0;
        foreach($itens as $item){
            $total+=$item->totalShop;
        }
        return $total;

    }

    function getTotalTaxAmount(array $itens) : int
    {
        $total = 0;

        foreach($itens as $item){
            $total+=$item->totalTax;
        }
        return $total;

    }


    


    public function getTotalTax($amount): int
    {
        if(!FILTER_VAR($amount, FILTER_VALIDATE_INT) || !$amount){
            $amount = 0;
        }
        return   ( ($this->percentage / 100) * $this->price ) * $amount;
        
    }

    public function getTotalShop($amount): int
    {
        if(!FILTER_VAR($amount, FILTER_VALIDATE_INT) || !$amount){
            $amount = 0;
        }
        return  ( ( ($this->percentage / 100) * $this->price ) + $this->price) * $amount;
        
    }

    

    

    

}


