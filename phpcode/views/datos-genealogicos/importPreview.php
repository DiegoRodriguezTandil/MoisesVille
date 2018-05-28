<?php
    use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\grid\GridView;
    
    
    $js = <<<JS
    
    $('#drop_import').on('click',function() {
        ajaxurl = $(this).attr('value');
        $.get( ajaxurl , function( data ) {
                if (data.rta == 'ok'){
                        $('#documentosMongo').html('');
                        var n = noty({
                                text: data.message,
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
                                text: data.message,
                                type: 'alert',
                                class: 'animated pulse',
                                layout: 'topRight',
                                theme: 'relax',
                                timeout: 3000, // delay for closing event. Set false for sticky notifications
                                force: false, // adds notification to the beginning of queue when set to true
                                modal: false, // si pongo true me hace el efecto de pantalla gris
                                killer : true
                        });
                }
        });
    })
JS;
    $this->registerJs($js);
    $script = <<< JS
    $(function() {
        $('.detalleDocumento').click(function () {
            $('#modal').modal('show').modal({backdrop: 'static',keyboard: false}).find('#divDocumento').load($(this).attr('url'));
        });
    });
JS;
    $this->registerJs($script);
?>
<div id="documentosMongo">
    <div class="row">
        <div class="pull-right">
            <?php
                echo Html::a("<span class='fa fa-trash'> Cancelar Importacion </span>",null,[
                        'title' => Yii::t('app', 'Cancelar Importacion'),
                        'id'=>'drop_import',
                        'value'=>   Url::to(["datos-genealogicos/cancelar-importacion/",'id' => $importacion_id]),
                        'class'=>'btn btn-info btn-xs',
                ]);
            ?>
        </div>
    </div>
    <div class="row">
        <?php
            if (!empty($dataProvider['dataProvider']) && !empty($dataProvider['columns'])){
                $colums  = $dataProvider['columns'];
                \yii\widgets\Pjax::begin();
                    echo GridView::widget([
                        'dataProvider'=> $dataProvider['dataProvider'],
                        'columns'=>  [$colums[2],$colums[3],$colums[4],$colums[5]],
                    ]);
                \yii\widgets\Pjax::end();
            }
        ?>
    </div>
</div>

