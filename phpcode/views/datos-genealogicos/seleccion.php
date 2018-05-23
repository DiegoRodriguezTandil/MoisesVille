<?php
    use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\grid\GridView;
    use yii\widgets\Pjax;
?>
    <?php
        $js = <<<JS
         $('.deleteSeleccion').on('click',function() {
            var ajaxurl = $(this).attr('url');
            var categoria_id = $(this).attr('categoria_id');
            var data = {
                categoria_id :  $(this).attr('categoria_id'),
                document_id  : $(this).attr('document_id'),
                accion : $(this).attr('accion')
            }
            $.post( ajaxurl , data ,function( data ) {
                  if (data.result == 'ok'){
                        ajaxurl = $('#urlRefresh').val();
                        $.get(ajaxurl,function(data) {
                            if (data.result == 'ok'){
                                $('#seleccion').html(data.html_seleccion);
                                 ajaxurl = $('#UrlSearch').val();
                                 var search_field = $('#search_field').val();
                                 ajaxurl += '&id='+ categoria_id;
                                 ajaxurl += '&q='+ search_field;
                                 $.get( ajaxurl , function( data ) {
                                        if (data.result == 'ok'){
                                            $('#gridview_documentos').html(data.info);
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
                                    }
                                 });
                            }
                        });
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
                  }
            });
        });
        
JS;
        $this->registerJs($js);
    ?>

    <?php
        $dataProvider2 = \app\models\Seleccion::getDataProvider();
        if (!empty($dataProvider2)){
            echo GridView::widget([
                'dataProvider'=> $dataProvider2,
                'columns' => [
                    'nombre',
                    'categoria_id',
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{delete}',
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
