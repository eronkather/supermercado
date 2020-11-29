<article class="result_tax">
        <h3 class="description"><?="{$tax->description}" ?></h3>
        <h3 class="percentage"><?="{$tax->percentage}" ?> </h3>
        <a class="update" href="#" data-action-update="<?=$router->route("taxcontroller.update");?>" data-id="<?=$tax->id;?>">Alterar</a>
        <a class="remove" href="#" data-action-delete="<?=$router->route("taxcontroller.delete"); ?>" data-id="<?=$tax->id;?>">Deletar</a>
</article>