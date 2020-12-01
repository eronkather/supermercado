<?php

namespace Tests;

require __DIR__ .  '/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use Source\Controllers\CartController;
use Source\Models\Product;

class ShopTest extends TestCase
{

    /**@test */
    public function testTotalShop()
    {
        $product = new Product();
        $prod = $product->findById(4);
        $cart = new CartController($prod);
        $total = $cart->getTotalShop(2);
        
        $this->assertEquals(300, $total);
    }

    /**@test */
    public function testShouldReturnZeroWhenPriceIsNotANumber()
    {
        $product = new Product();
        $prod = $product->findById(4);
        $cart = new CartController($prod);
        $total = $cart->getTotalShop('');
        
        $this->assertEquals(0, $total);
    }
}




?>