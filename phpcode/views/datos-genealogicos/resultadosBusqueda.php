<?php
    use yii\helpers\Html;
    use yii\helpers\Url;
    use kartik\grid\GridView;
    use yii\widgets\Pjax;
    use app\models\Categoria;
?>
<?php
    //Blindeo de eventos de seleccion y de borrado
    $js = <<<JS
                                        
        //Funcion de envio de mensajes a usurios
        function sendSuccessMessage(mensaje){
            var n = noty({
                text: mensaje,
                type: 'success',
                class: 'animated pulse',
                layout: 'topRight',
                theme: 'relax',
                timeout: 3000, // delay for closing event. Set false for sticky notifications
                force: false, // adds notification to the beginning of queue when set to true
                modal: false, // si pongo true me hace el efecto de pantalla gris
                killer : true,
            });
        }
        
        function sendErrorMessage(mensaje){
            var n = noty({
                text: mensaje,
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
        
        //Funcion que crea la url de busqueda dependiendo del id de categoria
        function getUrlRefresh(categoria_id){
            ajaxurl = $('#UrlSearch').val();
            var search_field = $('#search_field').val();
            ajaxurl += '&id='+ categoria_id;
            ajaxurl += '&q='+ search_field;
            return ajaxurl;
        }
        
        //Funcione de seleccion de documentos
        $('.seleccionDocumento').on('click',function() {
            var ajaxurl = $(this).attr('url');
            var categoria_id = $(this).attr('categoria_id');
            var accion = 0;
            var check = $(this).prop('checked');
            if (check) //Si fue check
                accion = 1
            var data = {
                categoria_id :  $(this).attr('categoria_id'),
                documentNombre : $(this).attr('documentNombre'),
                document_id  : $(this).attr('document_id'),
                accion : accion
            }
            $.post( ajaxurl , data ,function( data ) {
                    if (data.result == 'ok'){
                            ajaxurl = getUrlRefresh(categoria_id);
                            $.get(ajaxurl,function(data) {
                                if (data.result == 'ok'){
                                    $('#documentos_genealogicos').html(data.info);
                                     sendSuccessMessage(data.mensaje);
                                }
                            });
                    }else{
                          sendErrorMessage(data.mensaje);
                    }
            });
        })
        
        //Funcion de eliminacion de documentos
        $('.deleteSeleccion').on('click',function() {
            var ajaxurl = $(this).attr('url');
            var categoria_id = $(this).attr('categoria_id');
            $('.categorias').removeClass('active');
            $("#cat"+categoria_id).closest('a').addClass('active');
            var data = {
            categoria_id :  $(this).attr('categoria_id'),
            document_id  : $(this).attr('document_id'),
            accion : $(this).attr('accion')
            }
            $.post( ajaxurl , data ,function( data ) {
                if (data.result == 'ok'){
                    ajaxurl = getUrlRefresh(categoria_id);
                    $.get( ajaxurl , function( data ) {
                        if (data.result == 'ok'){
                            $('#documentos_genealogicos').html(data.info);
                            sendSuccessMessage(data.mensaje);
                        }else{
                            sendErrorMessage(data.mensaje);
                        }
                    });
                }else {
                    sendErrorMessage(data.mensaje);
                }
            });
        });
JS;

    
    //blindeo de eventos para levantar modal
    $script = <<< JS
   
        $(function() {
            $('.detalleDocumento').click(function () {
                $('#modal').modal('show').modal({backdrop: 'static',keyboard: false}).find('#divDocumento').load($(this).attr('url'));
            });
        });
JS;
    $this->registerJs($js);
    $this->registerJs($script);

?>
    <input id="urlModal" type="hidden" value="<?php echo Url::to(['datos-genealogicos/render-modal']); ?>">
    
    <div class="row">
        <div class="col-xs-12">
            <h3 style="margin:  0px;"> Documentos Seleccionados </h3>
            <div id="seleccion" style="overflow-y: scroll; max-height:250px"  >
                <?php
                    $dataProvider2 = \app\models\Seleccion::getDataProvider();
                    if (!empty($dataProvider2)){
                        echo GridView::widget([
                            'id' => 'table',
                            'dataProvider'=> $dataProvider2,
                            'summary'=>'',
                            'columns' => [
                                'nombre',
                                [
                                    'label' => 'Categoria',
                                    'attribute' => 'categoria_id',
                                    'format' => 'raw',
                                    'value' => function($data){
                                        $cat = Categoria::find()->where(['id' => $data['categoria_id']])->one();
                                        return $cat->descripcion;
                                    }
                                ],
                                [
                                    'class' => 'yii\grid\ActionColumn',
                                    'template' => '{delete}',
                                    'headerOptions' => ['style' => 'width:6%'],
                                    'buttons' => [
                                        'delete' => function ($url, $model) {
                                            return Html::a('<span class="fa fa-trash "></span>', null, [
                                                'title' => Yii::t('app', 'Delete'),
                                                'class' => 'btn btn-danger borrar btn-xs deleteSeleccion',
                                                'categoria_id' => $model['categoria_id'],
                                                'accion' => 0,
                                                'document_id' =>$model['documento_id'],
                                                'url' => Url::to(['datos-genealogicos/seleccionar-documentos'])
                                            ]);
                                        },
                                    ],
                                ],
                            ],
                        ]);
                        
                    }else{
                        echo "No se encuentran documentos seleccionados";
                    }
                ?>
            </div>

        </div>
    </div>
<br>
    <div id="gridview_documentos">
        <h3 style="margin:  0px;"> Resultados de Busqueda </h3>
        <div style="overflow-y: scroll;  max-height:500px">
            <?php
                Pjax::begin([]);
                if (!empty($dataProvider['dataProvider']) && !empty($dataProvider['columns'])){
                    $colums  = $dataProvider['columns'];
                    echo GridView::widget([
                        'dataProvider'=> $dataProvider['dataProvider'],
                        'floatHeader'=>true,
                        'hover' => true,
                        'floatHeaderOptions' => [
                            'position' => 'absolute'
                        ],
                        'summary'=>'',
                        'columns'=>  [$colums[1],$colums[2],$colums[3],$colums[4],$colums[5]],
                    ]);
                }else{
                    echo 'No se encontraron resultados para la busqueda';
                }
                Pjax::end();
            ?>
        </div>
       
    </div>

