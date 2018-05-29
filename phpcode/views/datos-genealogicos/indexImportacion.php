<?php
    use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\helpers\ArrayHelper;
    use yii\widgets\ActiveForm;
    use yii\bootstrap\Modal;
    use kartik\select2\Select2;
    use kartik\file\FileInput;
    use app\models\Categoria;
    rmrevin\yii\fontawesome\AssetBundle::register($this);
    $this->title = "Importacion de Datos Genealógicos";
    
    $script = <<< JS
    $(function() {
        $('.nuevaCat').click(function () {
            $('#modalCat').modal('show').modal({backdrop: 'static',keyboard: false}).find('#divCategoria').load($(this).attr('url'));
        });
    });
JS;
    $this->registerJs($script);
?>
    <?php
        Modal::begin([
            'id' => 'modal',
            'header' => '<h4 style="margin-top: 0px;margin-bottom: 0px;">Detalle Documento</h4>',
            'options' => ['tabindex' => false ],
        ]);
        echo "<div id='divDocumento'></div>";
        Modal::end();
    ?>
    <?php
        Modal::begin([
            'id' => 'modalCat',
            'header' => '<h4 style="margin-top: 0px;margin-bottom: 0px;">Agregar Categoría</h4>',
            'options' => ['tabindex' => false ],
        ]);
        echo "<div id='divCategoria'></div>";
        Modal::end();
    ?>
    <div class="row">
        <div id="col1" class="col-xs-4">
            <?php
                $form = ActiveForm::begin(['id'=>'form-importacion'  ,
                                            'options' => [
                                                'enctype'=>'multipart/form-data',
                                                'enableAjaxValidation' => true,
                                            ]
                ]);
                \yii\widgets\Pjax::begin(['id' => 'allCategorias']);
                $dataTipo = ArrayHelper::map(Categoria::find()->asArray()->all(), 'id', 'descripcion');
                echo $form->field($modelImportacion, 'categoria_id')->widget(Select2::classname(), [
                    'name' => 'selectCat',
                    'data' => $dataTipo,
                    'options' => ['placeholder' => 'Seleccionar Categoría ...'],
                    'pluginOptions' => [
                        'allowClear' => false
                    ],
                ]);
                \yii\widgets\Pjax::end([]);
                echo Html::a("<span class='fa fa-plus'> Nueva Categoría </span>",null,[
                    'title' => Yii::t('app', 'Agregar Categoria'),
                    'class'=>'btn btn-info btn-xs nuevaCat',
                    'url' => Url::to(["datos-genealogicos/agregar-cat/"]),
                ]);
    
                echo $form->field($modelImportacion, 'descripcion')->textarea(['rows' => '4']) ;
                echo FileInput::widget([
                    'model' => $modelImportacion,
                    'attribute' => 'excelFile',
                    'options' => [
                        'multiple' => false,
                        'allowedExtensions' => ['doc', 'xdoc', 'pdf', 'xlsx', 'xls']
                    ]
                ]);
                    
                ActiveForm::end();
            ?>
            <br>
        </div>
        
        <div id="col2" class="col-xs-8">
            <?php
              if (!empty($html)){
                  echo $html;
              }
            ?>
        </div>
    </div>


    
