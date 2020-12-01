<?php $v->layout("_theme", ["title" => "Produtos"]); ?>

<div class="create">
    <div class="form_ajax" style="display: none"></div>
    

        <?php
            if($products):
                foreach($products as $product):?>
                <form class="form" name="shop" action="<?=$router->route('shopcontroller.checkout')?>" method="post"
                enctype="multipart/form-data">
                <input type="hidden" class="id"  name="description" readonly value="<?=$product->id?>"/>
                <label>
                    <input type="text" class="description"  name="description" readonly value="<?=$product->description?>"/>
                </label>
                <label>
                    <input type="number" class="amount" value='0'  name="amount" min="0" />
                </label>
                <label>
                    <a class="update" data-action-add href="" data-id="<?=$product->description?>">Adicionar Produto</a>
                </label>
                </form>
                    
                <?php endforeach;
            endif;?>        

        
    
</div>

<div class="list">
    <div class="formCheckout"">
        <h1>Lista de Compras</h1>
    </div>
    <form class="formProducts" name="shop" action="<?=$router->route('shopcontroller.checkout')?>" method="post"
          enctype="multipart/form-data">

        <button data-button-insert data-id=''>Comprar</button>
    </form>
</div>


<?php $v->start('js'); ?>
<script>
    var count = 0;

    $(function(){
        
        
        $("body").on("click", "[data-button-insert]", function(e){
            e.preventDefault();
            
            var amountProducts = $('.formProducts').find('article').length;
            if(amountProducts == 0){
                alert('Selecione ao menos um produto');
            }else{
                $('.formProducts').submit();
            }
            console.log(amountProducts)
                 //console.log($(el).val().length);
                //$(this).submit();
         
                       
        });


    })
    $("body").on("click", "[data-action-delete]", function(e){
        e.preventDefault();
        
        var div = $(this).parent().parent().parent();
        div.fadeOut();
        count--;
    });

    $("body").on("click", "[data-action-add]", function(e){
        e.preventDefault();
        
        var divBt = $(this).closest('form');
        var description = divBt.find('.description').val();
        var amount = divBt.find('.amount').val();
        var id = divBt.find('.id').val();

        if(amount <= 0 || amount == ''){
            alert('Selecione a quantidade de produtos');
            return;
        }

        var div = $('.formProducts');       
        div.prepend('<article class="result_product lista_produtos"> <input type="hidden"  name="product['+count+'][id]" value="'+id+'"/><label> <h3> <input type="text"  name="product['+count+'][description]" readonly value="'+description+'"/></h3></label><label><h3><input type="text"  name="product['+count+'][amount]" value="'+amount+'"/></h3> </label> <label> <h3><a class="remove" href="#" data-action-delete=""> X </a></h3></label></article>');
        count ++;
        divBt.find('.amount').val(0);
    })
</script>
<?php $v->end('js'); ?>
