<?php
    use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\helpers\ArrayHelper;
    use yii\widgets\ActiveForm;
    use kartik\select2\Select2;
    use app\models\Coleccion;
?>
    <div class="row">
        <div id="col1" class="col-xs-3">
            <?php
                $form = ActiveForm::begin(['id'=>'form-importacion'  ,
                                            'options' => [
                                                'enableAjaxValidation' => true,
                                            ]
                ]);
                
                $dataTipo = ArrayHelper::map(Coleccion::find()->asArray()->all(), 'id', 'nombre');
                echo Select2::widget([
                    'name' => 'Categorias',
                    'data' => $dataTipo,
                ]);
                /*echo $form->field($model, 'uploadFile[]')->fileInput();
                $form->field($model, 'descripcion')->textInput()->hint('Agregar un descripción al la importacion');*/
                
                ActiveForm::end();
            ?>
        </div>
        
        <div id="col2" class="col-xs-9">
            <?php
                echo 'col 2';
                
            ?>
        </div>
    </div>
