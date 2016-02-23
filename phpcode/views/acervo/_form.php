<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use kartik\builder\Form;

/* @var $this yii\web\View */
/* @var $model app\models\Acervo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="acervo-form">   
    
    <?php     
    echo '<label class="control-label">Birth Date</label>';

    $form = ActiveForm::begin(
            ['type'=>ActiveForm::TYPE_VERTICAL]
            );


    ?>
    
    <?php
        $dataPublicar=ArrayHelper::map(\app\models\Publicar::find()->asArray()->all(), 'id', 'id');
        echo Form::widget([
            'model'=>$model,
            'form'=>$form,
            'columns'=>3,
            'attributes'=>[       // 2 column layout
                'nombre'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Nombre...']],
                'nroInventario'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Nro Inventario...']],
                'publicar_id'=>[
                    'type'=>Form::INPUT_CHECKBOX,                     
                    'items'=>['Si'=>'Publicar', 'No'=>'No Publicar'], 
                    'options'=>['inline'=>true, 'data-size'=>"md", 'value'=>"Si"],
                    'label'=>'Publicar en WEB',
                    'hint'=>'Tilde para publicar'
                ],
            ]
        ]);
        
        echo Form::widget([
            'model'=>$model,
            'form'=>$form,
            'columns'=>2,
            'attributes'=>[       // 2 column layout
                'fechaIngreso'=>[
                    'type'=>Form::INPUT_WIDGET, 
                    'widgetClass'=>'\kartik\widgets\DatePicker',
                    'pluginOptions' => [
                            'autoclose'=>true,
                            'format' => 'dd-M-yyyy'
                    ]                    
                ],
                'ingreso_id'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Ingreso..']],
            ]
        ]);

        
        echo Form::widget([
            'model'=>$model,
            'form'=>$form,
            'columns'=>2,
            'attributes'=>[       // 2 column layout               
                'material'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Material...']],
                'forma'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Forma...']]
            ]
        ]);
 
    ?>
    
    <div class="row">
        <div class="col-sm-6">
            <?php

                $dataTema=ArrayHelper::map(\app\models\Tema::find()->asArray()->all(), 'id', 'nombre');
                $dataColeccion = ArrayHelper::map(\app\models\Coleccion::find()->asArray()->all(), 'id', 'nombre');

                echo $form->field($model, 'tema_id')
                    ->dropDownList(
                        $dataTema,
                        ['prompt' => '-Tema-'],
                        ['id'=>'tema_id']
                    );
            ?>  
        </div>
        <div class="col-sm-6">
            <?php               
                echo $form->field($model, 'coleccion_id')
                    ->dropDownList(
                        $dataColeccion,
                        ['prompt' => '-Colección-'],
                        ['id'=>'coleccion_id']
                    );
            ?>  
        </div>
    </div>

    <?= $form->field($model, 'descripcion')->textarea(['rows' => 4]) ?>
    
     <?php
        $dataUnidadMedida = ArrayHelper::map(\app\models\UnidadMedida::find()->asArray()->all(), 'id', 'descripcion');
        $dataUnidadPeso = ArrayHelper::map(\app\models\UnidadPeso::find()->asArray()->all(), 'id', 'descripcion');
        echo Form::widget([
            'model'=>$model,
            'form'=>$form,
            'columns'=>4,
            'attributes'=>[       // 2 column layout
                'ancho'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Ancho...']],
                'largo'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Largo...']],
                'alto'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Alto...']],
                'unidadMedida_id'=>['type'=>Form::INPUT_WIDGET, 
                                    'widgetClass'=>'\kartik\widgets\Select2', 
                                    'options'=>['data'=>$dataUnidadMedida ], 
                                   // 'hint'=>'Seleccione unidad de medida'
                    ],  

                
            ]
        ]); 
             
        echo Form::widget([
            'model'=>$model,
            'form'=>$form,
            'columns'=>4,
            'attributes'=>[       // 2 column layout
                'diametroInterno'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Diametro Interno...']],
                'diametroExterno'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Diametro Externo...']],
                'peso'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Peso...']],
                'unidadPeso_id'=>['type'=>Form::INPUT_WIDGET, 
                                  'widgetClass'=>'\kartik\select2\Select2', 
                                  'options' => [
                                        'data'=>ArrayHelper::map(\app\models\UnidadPeso::find()->orderBy('descripcion')->asArray()->all(), 'id', 'descripcion'), 
                                       // 'hint'=>'Seleccione unidad de peso',
                                       // 'options' => ['placeholder' => 'Procurar solicitante ...'],
                                ],
                    ]
            ]      
        ]);
       
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
