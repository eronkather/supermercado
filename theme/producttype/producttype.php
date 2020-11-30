<article class="result_product_type">
        <h3 class="description"><?="{$productType->description}" ?></h3>
        <h3 class="taxes_id"><?="{$productType->taxes_id}" ?> </h3>
        <h3 class="taxes_description"><?="{$productType->tax->description}" ?> </h3>
        <a class="update" href="#" data-action-update="<?=$router->route("producttypecontroller.update");?>" data-id="<?=$productType->id;?>">Alterar</a>
        <a class="remove" href="#" data-action-delete="<?=$router->route("producttypecontroller.delete"); ?>" data-id="<?=$productType->id;?>">Deletar</a>
</article>