<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Tema */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tema-form">

    <?php $form = ActiveForm::begin(); ?>
    
       <?= $form->field($model, 'AcervoIds')->widget(Select2::classname(), [
   'data'=>$model->dropAcervo,
   'options' => ['multiple' => true]
  ]);?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
