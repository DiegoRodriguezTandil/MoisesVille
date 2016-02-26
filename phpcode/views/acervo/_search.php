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

    <?php // echo $form->field($model, 'tipoAcervo_id') ?>

    <?php // echo $form->field($model, 'ancho') ?>

    <?php // echo $form->field($model, 'largo') ?>

    <?php // echo $form->field($model, 'alto') ?>

    <?php // echo $form->field($model, 'unidadMedida_id') ?>

    <?php // echo $form->field($model, 'peso') ?>

    <?php // echo $form->field($model, 'unidadPeso_id') ?>

    <?php // echo $form->field($model, 'diametroInterno') ?>

    <?php // echo $form->field($model, 'diametroExterno') ?>

    <?php // echo $form->field($model, 'fechaIngreso') ?>

    <?php // echo $form->field($model, 'ingreso_id') ?>

    <?php // echo $form->field($model, 'estado_id') ?>

    <?php // echo $form->field($model, 'ubicacion_id') ?>

    <?php // echo $form->field($model, 'caracteristicas') ?>

    <?php // echo $form->field($model, 'lugarprocac') ?>

    <?php // echo $form->field($model, 'color') ?>

    <?php // echo $form->field($model, 'notas') ?>

    <?php // echo $form->field($model, 'fechaBaja') ?>

    <?php // echo $form->field($model, 'descEpoca') ?>

    <?php // echo $form->field($model, 'descUbicacion') ?>

    <?php // echo $form->field($model, 'nroA') ?>

    <?php // echo $form->field($model, 'nroB') ?>

    <?php // echo $form->field($model, 'nroC') ?>

    <?php // echo $form->field($model, 'nroD') ?>

    <?php // echo $form->field($model, 'motivoBaja_id') ?>

    <?php // echo $form->field($model, 'copia_id') ?>

    <?php // echo $form->field($model, 'codformaing') ?>

    <?php // echo $form->field($model, 'codtipoac') ?>

    <?php // echo $form->field($model, 'clasifac') ?>

    <?php // echo $form->field($model, 'publicar_id') ?>

    <?php // echo $form->field($model, 'idold') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
