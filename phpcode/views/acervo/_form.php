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
    $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL]);
    ?>
    
    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>
    
    <?php
        echo Form::widget([
            'model'=>$model,
            'form'=>$form,
            'columns'=>3,
            'attributes'=>[       // 2 column layout
                'nroInventario'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Nro Inventario...']],
                'material'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Material...']],
                'forma'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Forma...']]
            ]
        ]);

        $dataPost=ArrayHelper::map(\app\models\Tema::find()->asArray()->all(), 'id', 'nombre');
        $dataColeccion = ArrayHelper::map(\app\models\Coleccion::find()->asArray()->all(), 'id', 'nombre');
        echo Form::widget([
                'model'=>$model,
                'form'=>$form,
                'columns'=>2,
                'attributes'=>[       // 2 column layout                    
                    'tema_id'=>['type'=>Form::INPUT_WIDGET, 
                                    'widgetClass'=>'\kartik\widgets\Select2', 
                                    'options'=>['data'=>$dataPost], 
                                    'hint'=>'Seleccione el tema al que pertenece el acervo'
                    ],
                    'coleccion_id'=>['type'=>Form::INPUT_WIDGET, 
                                    'widgetClass'=>'\kartik\widgets\Select2', 
                                    'options'=>['data'=>$dataColeccion], 
                                    'hint'=>'Seleccione la colección a la que pertenece el acervo'
                    ]

                    ,
                ]
            ]);
        
        echo Form::widget([
            'model'=>$model,
            'form'=>$form,
            'columns'=>2,
            'attributes'=>[       // 2 column layout
                'diametroInterno'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Diametro Interno...']],
                'diametroExterno'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Diametro Externo...']],
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
        'format' => 'dd-M-yyyy'
    ]                    
                ],
                'ingreso_id'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Ingreso..']],
            ]
        ]);

    ?>

    <?= $form->field($model, 'descripcion')->textarea(['rows' => 6]) ?>
    
     <?php
   
        echo Form::widget([
            'model'=>$model,
            'form'=>$form,
            'columns'=>4,
            'attributes'=>[       // 2 column layout
                'ancho'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Ancho...']],
                'largo'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Largo...']],
                'alto'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Alto...']],
                'peso'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Peso...']],
            ]
        ]); 
       
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
