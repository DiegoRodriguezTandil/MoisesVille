<?php
    use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\grid\GridView;
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
                if (data.result == 'ok'){
                    $('#result').html(data.info);
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