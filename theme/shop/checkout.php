<?php $v->layout("_theme", ["title" => "Produtos"]); ?>

<div class="create">

<article class="result_product">
    <h3 class="description">Produto</h3>
    <h3 class="product_types_description">Total Produto </h3>
    <h3 class="product_types_description">Impostos </h3>
    <h3 class="price">Total </h3>
</article>
</article>

    <?php
        if($products):
            
            foreach($products as $product):?>
                <article class="result_product">
                    <h3 class="description"><?="{$product->description}" ?></h3>
                    <h3 class="product_total"> R$ <?="{$product->totalProductValue}" ?> </h3>
                    <h3 class="product_total_tax"> R$ <?="{$product->totalTax}" ?> </h3>
                    <h3 class="product_totalShop">R$ <?="{$product->totalShop}" ?> </h3>
                </article>
                
            <?php endforeach;
        endif;?>
        
        <article class="result_product">
            <h3 class="description">Total Geral dos Produtos</h3>
        </article>

        <article class="result_product">
            <h3 class="description">R$ <?=$totalShopAmount?></h3>
        </article>

        <article class="result_product">
            <h3 class="description">Total Geral dos Impostos</h3>
        </article>

        <article class="result_product">
            <h3 class="description">R$ <?=$totalTaxAmount?></h3>
        </article>

                    
    

  
</div>


