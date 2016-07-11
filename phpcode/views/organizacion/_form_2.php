<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Organizacion */
/* @var $form ActiveForm */
?>
<div class="form">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'id') ?>
        <?= $form->field($model, 'organizacionTipo_id') ?>
        <?= $form->field($model, 'info') ?>
        <?= $form->field($model, 'nuestrasColecciones') ?>
        <?= $form->field($model, 'nombre') ?>
        <?= $form->field($model, 'telefono') ?>
        <?= $form->field($model, 'email') ?>
        <?= $form->field($model, 'facebook') ?>
        <?= $form->field($model, 'twitter') ?>
        <?= $form->field($model, 'instagram') ?>
        <?= $form->field($model, 'googleMas') ?>
        <?= $form->field($model, 'linkedin') ?>
        <?= $form->field($model, 'imagen') ?>
        <?= $form->field($model, 'sitioWeb') ?>
        <?= $form->field($model, 'mapaLink') ?>
        <?= $form->field($model, 'direccion') ?>
        <?= $form->field($model, 'pais') ?>
        <?= $form->field($model, 'ciudad') ?>
        <?= $form->field($model, 'provincia') ?>
        <?= $form->field($model, 'cp') ?>
    
        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- _form -->
