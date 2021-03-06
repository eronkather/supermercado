<?php $v->layout("_theme", ["title" => "Tipo de Produtos"]); ?>

<div class="create">
    <div class="form_ajax" style="display: none"></div>
    <form class="form" name="tax" action="<?=$router->route('producttypecontroller.store')?>" method="post"
          enctype="multipart/form-data">
        <label>
            <input type="text" name="description" placeholder="Descrição do Tipo de Produto:"/>
        </label>
        <label>
            <select class="select_tax" name="taxes_id" id="taxes_id">
                <option value="">Selecione O Imposto</option>
                <?php
                    if($taxes):
                        foreach($taxes as $tax):?>
                            <option value=<?=$tax->id?>> <?=$tax->description?> </option>
                        <?php endforeach;
                    endif;?>        

                    
                ?>
            </select>
        </label>
        
        <button data-button='insert' data-id=''>Cadastrar Tipo de Produto</button>
    </form>
</div>

<section class="result">
    <?php 
    if(!empty($productTypes)):
        foreach($productTypes as $prodtType):    
        $v->insert("producttype/producttype", ["productType"=>$prodtType]);
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
                        if(callback.productType){
                            if(dataButton.id){
                                console.log(callback.productType);
                                divUpdate.replaceWith(callback.productType);
                            } else{
                                productTypes.prepend(callback.productType);
                            }
                            
                            form.each(function(){
                                this.reset();
                            })

                            //dataButton.id = '';
                           // $('button').attr('data-id', '') ;
                           $('button').data('id','');
                           $('button').data('button','insert');
                            $('button').html('Cadastrar Tipo de Produto');
                            divUpdate = "";
                            
                            $(this).html('Cadastrar Tipo de Produto');
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
            var taxesid = div.find('.taxes_id').text();
            
            $('button').data('id',$(this).data('id'));
            $('button').data('button','update');            
            $('button').html('Atualizar Tipo de Produto');
            $("input[name=description]").val(description);
            $("select").val(parseInt(taxesid)).change();
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
