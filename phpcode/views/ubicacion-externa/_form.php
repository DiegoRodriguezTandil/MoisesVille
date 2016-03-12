<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\widgets\ActiveForm;
use yii\bootstrap\TbButton;

/* @var $this yii\web\View */
/* @var $model app\models\UbicacionExterna */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ubicacion-externa-form">

    <?php $form = ActiveForm::begin([
                'options' => [
                    'id' => 'create-ue-form'
                ]
    ]); ?>
    
    <?php
        echo Form::widget([
                'model'=>$model,
                'form'=>$form,
                'columns'=>2,
                'attributes'=>[       // 2 column layout
                    'fechaInicio'=>[
                        'type'=>Form::INPUT_WIDGET, 
                        'widgetClass'=>kartik\datecontrol\DateControl::className(), 
                        'hint'=>'Ingrese Fecha de Inicio (dd/mm/aaaa)',
                    ],
                    'fechaCierre'=>[
                        'type'=>Form::INPUT_WIDGET, 
                        'widgetClass'=>kartik\datecontrol\DateControl::className(), 
                        'hint'=>'Ingrese Fecha de Cierro (dd/mm/aaaa)'
                    ],
                   ]
            ]);
    ?>

    <?= $form->field($model, 'ubicacion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'acervo_id')->textInput() ?>
    
    <?php 
    
   echo  Html::a(Yii::t('app', 'Save Ubicacion Externa'), ['create'], ['class' => 'btn btn-success',  'htmlOptions'=>array('onclick' => '$("#create-ue-form").submit()')]) 
    
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
