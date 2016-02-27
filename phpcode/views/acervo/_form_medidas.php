<?php

use yii\helpers\ArrayHelper;
use kartik\builder\Form;

/* @var $this yii\web\View */
/* @var $model app\models\Acervo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="acervo-form">       
    <?php
        
        $dataUnidadMedida = ArrayHelper::map(\app\models\UnidadMedida::find()->asArray()->all(), 'id', 'descripcion');
        $dataUnidadPeso = ArrayHelper::map(\app\models\UnidadPeso::find()->asArray()->all(), 'id', 'descripcion');
        echo Form::widget([
            'model'=>$model,
            'form'=>$form,
            'columns'=>4,
            'attributes'=>[       
                'ancho'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Ancho...']],
                'largo'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Largo...']],
                'alto'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Alto...']],
                'unidadMedida_id'=>['type'=>Form::INPUT_WIDGET, 
                                    'label'=>'Unidad de Medida',
                                    'widgetClass'=>'\kartik\widgets\Select2', 
                                    'options'=>['data'=>$dataUnidadMedida ], 
                    ],      
            ]
        ]); 
             
        echo Form::widget([
            'model'=>$model,
            'form'=>$form,
            'columns'=>4,
            'attributes'=>[       
                'diametroInterno'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Diametro Interno...']],
                'diametroExterno'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Diametro Externo...']],
                'peso'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Peso...']],
                'unidadPeso_id'=>['type'=>Form::INPUT_WIDGET, 
                                    'widgetClass'=>'\kartik\select2\Select2', 
                                    'label'=>'Unidad de Peso',
                                    'options' => [
                                        'data'=>ArrayHelper::map(\app\models\UnidadPeso::find()->orderBy('descripcion')->asArray()->all(), 'id', 'descripcion'),         
                                ],
                    ]
            ]      
        ]);
    
    ?>
</div>
