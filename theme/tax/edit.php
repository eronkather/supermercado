<?php $v->layout("_theme", ["title" => "Impostos"]); ?>

<div class="create">
    <div class="form_ajax" style="display: none"></div>
    <form class="form" name="tax" action="<?=$router->route('taxcontroller.store')?>" method="post"
          enctype="multipart/form-data">
        <label>
            <input type="text" name="description" placeholder="Descrição do Imposto:"/>
        </label>
        <label>
            <input type="number" step="0.01" name="percentage" placeholder="Porcentagem:"/>
        </label>
        <button data-button='insert' data-id=''>Cadastrar Imposto</button>
    </form>
</div>

<section class="result">
    <?php 
    if(!empty($taxes)):
        foreach($taxes as $tax):    
        $v->insert("tax/tax", ["tax"=>$tax]);
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
            var taxes = $('.result');
            var dataButton = $('button').data();

            console.log(dataButton.id);

            
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
                        if(callback.tax){
                            if(dataButton.id){
                                divUpdate.replaceWith(callback.tax);
                            } else{
                                taxes.prepend(callback.tax);
                            }
                            
                            form.each(function(){
                                this.reset();
                            })

                            //dataButton.id = '';
                           // $('button').attr('data-id', '') ;
                           $('button').data('id','');
                           $('button').data('button','insert');
                            $('button').html('Cadastrar Imposto');
                            divUpdate = "";
                            
                            $(this).html('Cadastrar Imposto');
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
            var percentage = div.find('.percentage').text();
            
            $('button').data('id',$(this).data('id'));
            $('button').data('button','update');            
            $('button').html('Atualizar Imposto');
            $("input[name=description]").val(description);
            $("input[name=percentage]").val(parseInt(percentage));
                        
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
            
            // $.post(data.actionDelete, data, function () {
            //     div.fadeOut();
            //     },"json").fail(function(xhr, textStatus, errorThrown){
            //         alert(errorThrown);
            //     //alert("Erro ao processar requisição");
            // });

        });
    })
</script>
<?php $v->end('js'); ?>
