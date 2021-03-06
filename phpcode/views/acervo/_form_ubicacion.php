<?php

use yii\helpers\ArrayHelper;
use kartik\builder\Form;
use yii\bootstrap\Modal;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Acervo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="acervo-form">     
    <?php  
        $dataUbicacion = ArrayHelper::map(\app\models\Ubicacion::find()->asArray()->all(), 'id', 'nombre');
        echo Form::widget([
            'model'=>$model,
            'form'=>$form,
            'columns'=> 2,
            'attributes'=>[       // 2 column layout               
                'ubicacion_id'=>['type'=>Form::INPUT_WIDGET, 'label'=>'Ubicación',
                                'widgetClass'=>'\kartik\widgets\Select2', 
                                'options'=>['data'=>$dataUbicacion ], 
                                // 'hint'=>'Seleccione unidad de medida'
                    ],
                'descUbicacion'=>['type'=>Form::INPUT_TEXT, 'label'=>'Más detalles ubicación','options'=>['placeholder'=>'Más detalles...']],        
            ]
        ]);
    ?>
    <h4>Ubicación Externa</h4>
    <?php
        Modal::begin([
            'header' => 'Ubicación Externa',
            'toggleButton' => [
                'label' => '<i class="glyphicon glyphicon-plus"></i> Agregar Ubicación Externa',
                'class' => 'btn btn-success'
            ],
            'size' => 'modal-lg',
        ]);
        
        echo $this->render(
            '/ubicacion-externa/_form', 
            [
                'model' => new \app\models\UbicacionExterna(),
                'form'  => $form
            ]
        );
        
        Modal::end();
    ?>
            
    <?= GridView::widget([
        'dataProvider' => $dataProviderUbicacionExterna,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute'=>'fechaInicio',   
                'format' => ['date', 'php:d/m/Y'], 
            ],
            [
                'attribute'=>'fechaCierre',   
                'format' => ['date', 'php:d/m/Y'], 
            ],
            'ubicacion',
            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
