<?php
    use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\helpers\ArrayHelper;
    use yii\bootstrap\Modal;
    use app\models\Categoria;
    rmrevin\yii\fontawesome\AssetBundle::register($this);
    $this->title = "Datos Genealógicos";
?>
<?php
    $script = <<< JS
    $(function() {
        $('.detalleDocumento').click(function () {
            $('#modal').modal('show').find('#divDocumento').load($(this).attr('value'));
        });
    });
JS;
    $Css = <<<CSS
    .vertical-menu {
        width:auto;
        height: auto;
        overflow-y: auto;
    }
    
    .vertical-menu a {
        background-color: #eee; /* Grey background color */
        color: black; /* Black text color */
        display: block; /* Make the links appear below each other */
        padding: 12px; /* Add some padding */
        text-decoration: none; /* Remove underline from links */
    }
    
    .vertical-menu a:hover {
        background-color: #ccc; /* Dark grey background on mouse-over */
    }
    
    .vertical-menu a.active {
        background-color: #32b3ff; /* Add a green color to the "active/current" link */
        color: white;
    }

    .loader {
        border: 16px solid #32b3ff; /* Light grey */
        border-top: 16px solid #000000; /* Blue */
        border-radius: 50%;
        height: 90px;
        margin: 100px auto 0;
        width: 90px;
        text-align: center;
        animation: spin 2s linear infinite;
    }
    
    .loader > div {
      width: 18px;
      height: 18px;
      background-color: rgba(2,13,7,0.33);
      border-radius: 100%;
      display: inline-block;
      -webkit-animation: sk-bouncedelay 1.4s infinite ease-in-out both;
      animation: sk-bouncedelay 1.4s infinite ease-in-out both;
    }
    
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
CSS;
    $this->registerCss($Css);

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

        $.fn.pressEsc = function(fn) {
                    return this.each(function() {
                            $(this).bind('escPress', fn);
                                $(this).keyup(function(e){
                                    if(e.keyCode == 27)
                                    {
                                      $(this).trigger("escPress");
                                    }
                                })
                        });
                };
        
        function getData(ajaxurl) {
            var search_field = $('#search_field').val();
            ajaxurl += '&q='+ search_field;
            $('#gridview_documentos').html('<div class="loader" ></div>');
            $.get( ajaxurl , function( data ) {
                var arr = data.count;
                for (var key in arr) {
                    $("#"+key).html(" "+arr[key]+" - ");
                }
                if (data.result == 'ok'){
                   
                    $('#documentos_genealogicos').html(data.info);
                }else{
                    $('#documentos_genealogicos').html(data.info);
                }
            }).fail(function() {
                $('#gridview_documentos').html("<h4>Ocurrio un error durante la busqueda de documentos</h4>");
            });
        }
        
        $(document).ready(function() {
            $('#cat1').closest('a').addClass('active');
        })
        
        $('#search_field').pressEnter(function() {
            ajaxurl = $('#defaultUrlSearch').val();
            $('.categorias').removeClass('active');
            $('#cat1').closest('a').addClass('active');
            getData(ajaxurl);
        })
        
        $('.categorias').on('click',function() {
            $('.categorias').removeClass('active');
            $(this).addClass('active');
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
    echo "<div id='divDocumento' class='modalDatos'></div>";
    Modal::end();
    Modal::begin([
        'id' => 'modalMail',
        'header' => '<h4 style="margin-top: 0px;margin-bottom: 0px;">Envio de Mail</h4>',
        'options' => ['tabindex' => false ],
    ]);
    echo "<div id='formMail' class='modalDatos' ></div>";
    Modal::end();
?>
<div class="row">
    <div class="pull-right">
        <div class="cols-xs-8">
            <?php
                echo Html::a("<span class='fa fa-plus'> Nueva Importación </span>",Url::to(["datos-genealogicos/importacion/"]),[
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
    <div class="col-xs-3">
        <input id="search_field" type="text" name="q" class="form-control" placeholder="Buscar..."?>
        <input id="UrlSearch" type="hidden" value="<?php echo Url::to(['datos-genealogicos/buscar']);?>">
        <br>
        <div class="vertical-menu" style="overflow-y: scroll;  max-height:600px">
            <?php
                $categorias = Categoria::find()->select(['id', 'descripcion'])->all();
                foreach ($categorias as $categoria) {
                        $url = Url::to(['datos-genealogicos/buscar','id' => $categoria->id]);
                        echo"<a class='categorias' value='{$url}'> <span id='cat{$categoria->id}' class=''></span> {$categoria->descripcion}  </a>
                             ";
                }
            ?>
        </div>
        
    </div>
    
    <div class="col-xs-9" >
        <div class="row" >
            <div id="documentos_genealogicos">
                <?php echo $html; ?>
            </div>
        </div>
    </div>
   
</div>
<br>

