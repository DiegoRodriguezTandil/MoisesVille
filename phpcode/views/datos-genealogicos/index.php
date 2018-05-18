<?php
    use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\helpers\ArrayHelper;
    use app\models\Coleccion;
    use yii\grid\GridView;
    use yii\widgets\Pjax;
?>
<?php
    $js = <<<JS
        $('.categorias').on('click',function() {
            ajaxurl = $(this).attr('value');
            $.get( ajaxurl , function( data ) {
                if (data.result == 'ok'){
                        $.pjax.reload({container: '#documentos_genealogicos'})
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
<div class="row">
    <div class="pull-right">
        <?php
            echo Html::a("<span class='fa fa-envelope'> Nueva Importacion </span>",Url::to(["datos-genealogicos/importacion/"]));
            echo Html::a("<span class='fa fa-plus'> Enviar Mail </span>",Url::to(["datos-genealogicos/enviar-mail/"]));
        ?>
    </div>
</div>
<br>
<div class="row">
    <div class="col-xs-3">
        <?php
            $first = true;
            $categorias = Coleccion::find()->select(['id', 'nombre'])->all();
            foreach ($categorias as $categoria) {
                if (!$first){
                    $url = Url::to(['datos-genealicos/buscar','id' => $categoria->id]);
                    echo"
                        <span class='categorias' value='{$url}'> {$categoria->nombre} </span>
                        <br>
                    ";
                }else{
                    $first = FALSE;
                }
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
                    foreach ($datos as $dato) {
                        var_dump($dato);
                    }
                ?>
            <?php Pjax::end(); ?>
        </div>
    </div>
    
</div>

