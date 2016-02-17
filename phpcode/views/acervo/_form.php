<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Acervo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="acervo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descripcion')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'nroInventario')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'forma')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'material')->textInput(['maxlength' => true]) ?>
    
    <?php 
        $dataPost=ArrayHelper::map(\app\models\Tema::find()->asArray()->all(), 'id', 'nombre');
        echo $form->field($model, 'tema_id')
        ->dropDownList(
            $dataPost,
            ['prompt' => '-Seleccione Tema-'],
            ['id'=>'tema_id'],
            ['style'=>'width:50%']    
        );
    
    ?>
    
     <?php 
        $dataPost=ArrayHelper::map(\app\models\TipoAcervo::find()->asArray()->all(), 'id', 'descripcion');
        echo $form->field($model, 'tipoAcervo_id')
        ->dropDownList(
            $dataPost,
            ['prompt' => '-Seleccione Tema-'],
            ['id'=>'tema_id'],
            ['style'=>'width:50%']    
        );
    
    ?>

    <?= $form->field($model, 'ancho')->textInput() ?>

    <?= $form->field($model, 'largo')->textInput() ?>

    <?= $form->field($model, 'alto')->textInput() ?>

    <?= $form->field($model, 'peso')->textInput() ?>

    <?= $form->field($model, 'diametroInterno')->textInput() ?>

    <?= $form->field($model, 'diametroExterno')->textInput() ?>

    <?= $form->field($model, 'fechaIngreso')->textInput(['maxlength' => true]) ?>
    
    <?php echo DatePicker::widget([
    'model' => $model,
    'attribute' => 'fechaIngreso',
    //'language' => 'ru',
    //'dateFormat' => 'yyyy-MM-dd',
]); ?> 

    <?= $form->field($model, 'ingreso_id')->textInput() ?>

    <?php 
        $dataPost=ArrayHelper::map(\app\models\Coleccion::find()->asArray()->all(), 'id', 'nombre');
        echo $form->field($model, 'coleccion_id')
        ->dropDownList(
            $dataPost,
            ['prompt' => '-Seleccione Colección-'],
            ['id'=>'coleccion_id'],
            ['style'=>'width:50%']    
        );
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
