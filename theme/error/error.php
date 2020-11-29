<?php $v->layout("_theme"); ?>

<div class="error">
    <h2>Oooooops  <?=$error;?> </h2>
    <h3> A página que você está tentando acessar não existe </h3>
</div>

<?php $v->start('sidebar');?>

    <a href="<?=url();?>" title="voltar ao início">Volar</a>

<?php $v->end();?>

