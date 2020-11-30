<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> <?= $title; ?></title>

    <link rel="stylesheet" href="<?= url("/theme/assets/css/style.css"); ?>"/>
</head>
<body>

<div class="ajax_load">
    <div class="ajax_load_box">
        <div class="ajax_load_box_circle"></div>
        <div class="ajax_load_box_title">Aguarde, carregando!</div>
    </div>
</div>

<nav class="main_nav">
    <?php if($v->section('sidebar')):
            echo $v->section('sidebar');
    else:
        ?>
            <a title="" href="<?=url('/products');?>">Produtos</a>
            <a title="" href="<?=url('/taxes');?>">Impostos</a>
            <a title="" href="<?=url('/producttypes');?>">Tipos de Produto</a>
            <a title="" href="<?=url('/sales');?>">Venda</a>
            
    <?php
    endif;?>
</nav>

<main class="content">
    <?= $v->section("content"); ?>
</main>

<script src="<?= url("/theme/assets/js/jquery.js"); ?>"></script>
<?= $v->section("js"); ?>
</body>
</html>