<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use frontend\models\Colecciones;
use frontend\models\Tema;
use yii\jui\DatePicker;


/* @var $this yii\web\View */
/* @var $model frontend\models\Objetos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="objetos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descripcion')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'nroInventario')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'forma')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'material')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'colecciones_id')->
        dropDownList(
            ArrayHelper::map(
                Colecciones::find()->all(),'id','nombre'
            ),
            ['prompt'=>'Seleccionar']
        ); 
    ?>

    <?= $form->field($model, 'tema_id')->
        dropDownList(
            ArrayHelper::map(
                Tema::find()->all(),'id','nombre'
            ),
            ['prompt'=>'Seleccionar']
        ); 
    ?>

    <?= $form->field($model, 'tipoAcervo_id')->
        dropDownList(
            ArrayHelper::map(
                \frontend\models\TipoAcervo::find()->all(),'id','nombre'
            ),
            ['prompt'=>'Seleccionar']
        ); 
    ?>

    <?= $form->field($model, 'ancho')->textInput() ?>

    <?= $form->field($model, 'largo')->textInput() ?>

    <?= $form->field($model, 'alto')->textInput() ?>

    <?= $form->field($model, 'peso')->textInput() ?>

    <?= $form->field($model, 'diametroInterno')->textInput() ?>

    <?= $form->field($model, 'diametroExterno')->textInput() ?>

    <?= $form->field($model, 'fechaIngreso')->widget(
            DatePicker::classname(), [
                'model' => $model,
                'attribute' => 'fechaIngreso',
                'language' => 'es',
                'dateFormat' => 'dd/MM/yyyy',
        ]);       
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
