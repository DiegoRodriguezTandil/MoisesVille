<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AcervoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="acervo-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'nombre') ?>

    <?= $form->field($model, 'descripcion') ?>

    <?= $form->field($model, 'nroInventario') ?>

    <?= $form->field($model, 'forma') ?>

    <?php // echo $form->field($model, 'material') ?>

    <?php // echo $form->field($model, 'tema_id') ?>

    <?php // echo $form->field($model, 'tipoAcervo_id') ?>

    <?php // echo $form->field($model, 'ancho') ?>

    <?php // echo $form->field($model, 'largo') ?>

    <?php // echo $form->field($model, 'alto') ?>

    <?php // echo $form->field($model, 'peso') ?>

    <?php // echo $form->field($model, 'diametroInterno') ?>

    <?php // echo $form->field($model, 'diametroExterno') ?>

    <?php // echo $form->field($model, 'fechaIngreso') ?>

    <?php // echo $form->field($model, 'ingreso_id') ?>

    <?php // echo $form->field($model, 'coleccion_id') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
