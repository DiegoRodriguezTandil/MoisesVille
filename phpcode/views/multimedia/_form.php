<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Multimedia */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="multimedia-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'path')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'webPath')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tipoMultimedia_id')->textInput() ?>
    
    <?php 
        $dataPost=ArrayHelper::map(\app\models\TipoMultimedia::find()->asArray()->all(), 'id', 'nombre');
        echo $form->field($model, 'tipoMultimedia_id')
        ->dropDownList(
            $dataPost,
            ['prompt' => '---'],
            ['id'=>'tipoMultimedia_id'],
            ['style'=>'width:50%']    
        );
    
    ?>

    <?= $form->field($model, 'objetos_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
