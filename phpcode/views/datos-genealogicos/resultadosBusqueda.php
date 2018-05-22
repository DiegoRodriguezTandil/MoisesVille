<?php
    use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\grid\GridView;
    use yii\widgets\Pjax;
?>
<?php
    $js = <<<JS
    $('.seleccionDocumento').on('click',function() {
        var ajaxurl = $(this).attr('url');
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
                $.pjax.reload({container:"#seleccion"});
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
    })
JS;
    $script = <<< JS
    $(function() {
        $('.detalleDocumento').click(function () {
            $('#modal').modal('show').find('#divDocumento').load($(this).attr('value'));
        });
    });
JS;
    $this->registerJs($script);
    $this->registerJs($js);
    
?>
    <div class="row">
        <?php Pjax::begin(['id'=>'seleccion']); ?>
        <?php
            $dataProvider2 = \app\models\Seleccion::getDataProvider();
            if (!empty($dataProvider2)){
                echo GridView::widget([
                    'dataProvider'=> $dataProvider2,
                    'columns' => [
                        'nombre',
                        'categoria_id',
                    ],
                ]);
            }
        ?>
        <?php Pjax::end(); ?>
    </div>
    <div class="row">
        <?php
            if (!empty($dataProvider['dataProvider']) && !empty($dataProvider['columns'])){
                $colums  = $dataProvider['columns'];
                echo GridView::widget([
                    'dataProvider'=> $dataProvider['dataProvider'],
                    'columns'=>  [$colums[1],$colums[2],$colums[3],$colums[4],$colums[5]],
                ]);
            
            }else{
                echo 'No se encontraron resultados para la busqueda';
            }
        ?>
    </div>
