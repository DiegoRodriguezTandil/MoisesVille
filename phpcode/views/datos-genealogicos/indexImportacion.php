<?php
    use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\helpers\ArrayHelper;
    use yii\widgets\ActiveForm;
    use kartik\select2\Select2;
    use kartik\file\FileInput;
    use app\models\Categoria;
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
                
                    $dataTipo = ArrayHelper::map(Categoria::find()->asArray()->all(), 'id', 'descripcion');
                    echo $form->field($modelImportacion, 'categoria_id')->widget(Select2::classname(), [
                        'data' => $dataTipo,
                        'options' => ['placeholder' => 'Seleccionar Categoria ...'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]);
                    echo $form->field($modelImportacion, 'descripcion')->textarea(['rows' => '6']) ;
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


    
