<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\builder\Form;

/* @var $this yii\web\View */
/* @var $model app\models\TipoAcervo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tipo-acervo-form">

    <?php 
    $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL]);
    ?>

    <?php 
        $dataTipoAcervo=ArrayHelper::map(\app\models\TipoAcervo::find()->where(['is', 'tipoAcervo_id', NULL])->asArray()->all(), 'id', 'descripcion');
        echo Form::widget([
                'model'=>$model,
                'form'=>$form,
                'columns'=>2,
                'attributes'=>[       // 2 column layout                    
                    'descripcion'=>['type'=>Form::INPUT_TEXT,                                     
                                    'options'=>['placeholder'=>'Descripcion...']],
                    'tipoAcervo_id'=>['type'=>Form::INPUT_WIDGET, 
                                    'widgetClass'=>'\kartik\widgets\Select2', 
                                    'options'=>['data'=>$dataTipoAcervo], 
                                    'pluginOptions' => [
                                        'allowClear' => true
                                    ],
                                    'hint'=>'Seleccione la colección a la que pertenece el acervo'
                    ]

                    ,
                ]
            ]);
        
     ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
