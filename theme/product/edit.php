<?php $v->layout("_theme", ["title" => "Produtos"]); ?>

<div class="create">
    <div class="form_ajax" style="display: none"></div>
    <form class="form" name="product" action="<?=$router->route('productcontroller.store')?>" method="post"
          enctype="multipart/form-data">
        
        <label>
            <input type="text" name="description" placeholder="Descrição do Produto:"/>
        </label>
        <input type="number" step="0.01" name="price" placeholder="Preço do Produto:"/>
        <label>
            <select class="select_tax" name="product_type_id" id="product_type_id">
                <option value="">Selecione O Tipo de Produto</option>
                <?php
                    if($producttypes):
                        foreach($producttypes as $producttype):?>
                            <option value=<?=$producttype->id?>> <?=$producttype->description?> </option>
                        <?php endforeach;
                    endif;?>        

                    
                ?>
            </select>
        </label>
        
        <button data-button='insert' data-id=''>Cadastrar Produto</button>
    </form>
</div>

<section class="result">
    <?php 
    if(!empty($products)):
        foreach($products as $product):    
        $v->insert("product/product", ["product"=>$product]);
        endforeach; 
    endif;
    ?>
</section>

<?php $v->start('js'); ?>
<script>
    var divUpdate = "";

    $(function(){
        function load(action){
            var load_div = $('.ajax_load');
            if (action === 'open') {
                load_div.fadeIn().css('display','flex');                                
            } else{
                load_div.fadeOut();
            }
        }

        
        $('.form').submit(function(e){
            e.preventDefault();
            
            var form = $(this);
            var form_ajax = $('.form_ajax');
            var productTypes = $('.result');
            var dataButton = $('button').data();

            console.log(dataButton.id);

                console.log(form.serialize()+'&'+$.param({ 'id': dataButton.id }));
                $.ajax({
                    type: dataButton.id?"PATCH":"POST",
                    url: form.attr('action'),
                    data: dataButton.id?form.serialize()+'&'+$.param({ 'id': dataButton.id }):form.serialize(),
                    dataType: "JSON",
                    beforeSend: function(){
                        load("open");
                    },
                    success: function (callback) {                      
                        if(callback.message){
                            form_ajax.html(callback.message).fadeIn();
                        } else{
                            form_ajax.fadeOut(function(){
                                $(this).html("");
                            });
                        }
                        if(callback.product){
                            if(dataButton.id){
                                divUpdate.replaceWith(callback.product);
                            } else{
                                productTypes.prepend(callback.product);
                            }
                            
                            form.each(function(){
                                this.reset();
                            })

                            //dataButton.id = '';
                           // $('button').attr('data-id', '') ;
                           $('button').data('id','');
                           $('button').data('button','insert');
                            $('button').html('Cadastrar Produto');
                            divUpdate = "";
                            
                            $(this).html('Cadastrar Produto');
                        }
                    },
                    complete: function(){
                        load("close");
                    }
                    
                });
            
            
        });


        $("body").on("click", "[data-action-update]", function(e){
            e.preventDefault();
            divUpdate = $(this).closest("article");
            var div = $(this).parent();
            var description = div.find('.description').text();
            var productid = div.find('.product_type_id').text();
            var price = parseInt(div.find('.price').text());

            
            $('button').data('id',$(this).data('id'));
            $('button').data('button','update');            
            $('button').html('Atualizar Produto');
            $("input[name=description]").val(description);
            $("input[name=price]").val(price);
            $("select").val(parseInt(productid)).change();

            
        });

        $("body").on("click", "[data-action-delete]", function(e){
                e.preventDefault();
            
            var data = $(this).data();
            var div = $(this).parent();
            
            $.ajax({
                type: "DELETE",
                url: data.actionDelete,
                data: data,
                dataType: "json",
                beforeSend: function(){
                    load("open");
                },
                complete: function(){
                    load("close");
                },
                success: function (response) {
                    if(!response.remove){
                        alert("Erro ao processar requisição");
                    } else{
                        div.fadeOut();
                    }
                }
            });

        });
    })
</script>
<?php $v->end('js'); ?>
