<?php
    use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\helpers\ArrayHelper;
    use yii\grid\GridView;
    use yii\widgets\Pjax;
    use app\models\Categoria;
?>
<?php
    $js = <<<JS
    
        $.fn.pressEnter = function(fn) {
            return this.each(function() {
                    $(this).bind('enterPress', fn);
                        $(this).keyup(function(e){
                            if(e.keyCode == 13)
                            {
                              $(this).trigger("enterPress");
                            }
                        })
                });
        };
        
        function getData(ajaxurl) {
            var search_field = $('#search_field').val();
            ajaxurl += '&q='+ search_field;
            $.get( ajaxurl , function( data ) {
                $('#documentos_genealogicos').html(data.info);
                if (data.result == 'ok'){
                        var n = noty({
                                text: data.mensaje,
                                type: 'success',
                                class: 'animated pulse',
                                layout: 'topRight',
                                theme: 'relax',
                                timeout: 3000, // delay for closing event. Set false for sticky notifications
                                force: false, // adds notification to the beginning of queue when set to true
                                modal: false, // si pongo true me hace el efecto de pantalla gris
                                killer : true,
                        });
                }else{
                     var n = noty({
                                text: data.mensaje,
                                type: 'warning',
                                class: 'animated pulse',
                                layout: 'topRight',
                                theme: 'relax',
                                timeout: 3000, // delay for closing event. Set false for sticky notifications
                                force: false, // adds notification to the beginning of queue when set to true
                                modal: false, // si pongo true me hace el efecto de pantalla gris
                                killer : true,
                        });
                }
            });
        }
        
        $('#search_field').pressEnter(function() {
            ajaxurl = $('#defaultUrlSearch').val();
            getData(ajaxurl);
        })
        
        $('.categorias').on('click',function() {
            ajaxurl = $(this).attr('value');
            getData(ajaxurl);
        });
JS;
$this->registerJs($js);
?>
<div class="row">
    <div class="pull-right">
        <?php
            echo Html::a("<span class='fa fa-envelope'> Nueva Importacion </span>",Url::to(["datos-genealogicos/importacion/"]));
            echo Html::a("<span class='fa fa-plus'> Enviar Mail </span>",Url::to(["datos-genealogicos/enviar-mail/"]));
        ?>
    </div>
</div>
<div class="row">
    <div class="col-xs-5">
        <input id="search_field" type="text" name="q" class="form-control" placeholder="Buscar..."?>
    </div>
</div>
<br>
<div class="row">
    <?php $durl = Url::to(['datos-genealogicos/buscar','id' => 1]);
    echo "<input id=\"defaultUrlSearch\" name=\"prodId\" type=\"hidden\" value='$durl'";
    
    ?>
    <input id="defaultUrlSearch" name="prodId" type="hidden" value="xm234jq">
    <div class="col-xs-3">
        <?php
            $categorias = Categoria::find()->select(['id', 'descripcion'])->all();
            foreach ($categorias as $categoria) {
                
                    $url = Url::to(['datos-genealogicos/buscar','id' => $categoria->id]);
                    echo"
                        <span class='categorias' value='{$url}'> {$categoria->descripcion} </span>
                        <br>
                
               ";
            }
        ?>
    </div>
    
    <div class="col-xs-9">
        <div class="row">
            <?php Pjax::begin(['id'=>'seleccion']); ?>
            <?php
               echo 'hola';
            ?>
            <?php Pjax::end(); ?>
        </div>
        <div class="row">
            <?php Pjax::begin(['id'=>'documentos_genealogicos']); ?>
                <?php
                    echo $html;
                ?>
            <?php Pjax::end(); ?>
        </div>
    </div>
    
</div>

