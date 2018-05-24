<?php
    use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\helpers\ArrayHelper;
    use yii\grid\GridView;
    use yii\bootstrap\Modal;
    use app\models\Categoria;
    rmrevin\yii\fontawesome\AssetBundle::register($this);
?>
<?php
    $script = <<< JS
    $(function() {
        $('.detalleDocumento').click(function () {
            $('#modal').modal('show').find('#divDocumento').load($(this).attr('value'));
        });
    });
JS;

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
                                type: 'error',
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
        
        $('.sendMail').click(function () {
            $('#modalMail').modal('show').modal({backdrop: 'static',keyboard: false}).find('#formMail').load($(this).attr('url'));
        });
JS;
$this->registerJs($js);
$this->registerJs($script);
?>
<?php
    Modal::begin([
        'id' => 'modal',
        'header' => '<h4 style="margin-top: 0px;margin-bottom: 0px;">Detalle Documento</h4>',
        'options' => ['tabindex' => false ],
    ]);
    echo "<div id='divDocumento' ></div>";
    Modal::end();
    Modal::begin([
        'id' => 'modalMail',
        'header' => '<h4 style="margin-top: 0px;margin-bottom: 0px;">Envio de Mail</h4>',
        'options' => ['tabindex' => false ],
    ]);
    echo "<div id='formMail' ></div>";
    Modal::end();
?>
<div class="row">
    <div class="pull-right">
        <div class="cols-xs-8">
            <?php
                echo Html::a("<span class='fa fa-plus'> Nueva Importacion </span>",Url::to(["datos-genealogicos/importacion/"]),[
                    'title' => Yii::t('app', 'Nueva Importacion'),
                    'class'=>'btn btn-info btn-xs',
                ]);
            ?>
        
            <?php
                echo Html::a("<span class='fa fa-envelope'> Enviar Mail </span>",null,[
                    'title' => Yii::t('app', 'Enviar Mail'),
                    'class'=>'btn btn-info btn-xs sendMail',
                    'url' => Url::to(["datos-genealogicos/enviar-mail/"]),
                ]);
            ?>
        </div>

    </div>
</div>

<div class="row">
    <?php $durl = Url::to(['datos-genealogicos/buscar','id' => 1]);
    echo "<input id=\"defaultUrlSearch\" name=\"prodId\" type=\"hidden\" value='$durl'";
    ?>
    <input id="defaultUrlSearch" name="prodId" type="hidden" value="xm234jq">
    <div class="col-xs-2">
        <input id="search_field" type="text" name="q" class="form-control" placeholder="Buscar..."?>
        <input id="UrlSearch" type="hidden" value="<?php echo Url::to(['datos-genealogicos/buscar']);?>">
        <br>
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
    
    <div class="col-xs-9" >
        <div class="row" >
            <div id="documentos_genealogicos">
                <?php echo $html; ?>
            </div>
        </div>
    </div>
    
</div>

