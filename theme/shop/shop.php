
<article class="result_product">
        <h3 class="description"><?="{$product->description}" ?></h3>
        <h3 class="product_type_id"><?="{$product->product_type_id}" ?> </h3>
        <h3 class="product_types_description"><?="{$product->productType->description}" ?> </h3>
        <h3 class="price"><?="{$product->price}" ?> </h3>
        <a class="update" href="#" data-action-update="<?=$router->route("productcontroller.update");?>" data-id="<?=$product->id;?>">Alterar</a>
        <a class="remove" href="#" data-action-delete="<?=$router->route("productcontroller.delete"); ?>" data-id="<?=$product->id;?>">Deletar</a>
</article>