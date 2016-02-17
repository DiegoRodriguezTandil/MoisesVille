<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
//use yii\kartik\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TipoAcervo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tipo-acervo-form">

    <?php $form = ActiveForm::begin([
                    'layout' => 'horizontal',
                    'fieldConfig' => [
                        'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
                        'horizontalCssClasses' => [
                            'label' => 'col-sm-4',
                            'offset' => 'col-sm-offset-4',
                            'wrapper' => 'col-sm-8',
                            'error' => '',
                            'hint' => '',
                        ],
                    ],
                ]); 
    ?>

    <?= $form->field($model, 'descripcion')->textInput(['maxlength' => true]) ?>
    
    <?php 
        $dataPost=ArrayHelper::map(\app\models\TipoAcervo::find()->where(['is', 'tipoAcervo_id', NULL])->asArray()->all(), 'id', 'descripcion');
        echo $form->field($model, 'tipoAcervo_id')
        ->dropDownList(
            $dataPost,
            ['prompt' => '---'],
            ['id'=>'tipoAcervo_id'],
            ['style'=>'width:50%']    
        );
    
    ?>

    <div class="form-group">
        <div class="col-lg-offset-4 col-lg-8">
             <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>

    <!--div class="form-group">
       
    </div>

    <?php ActiveForm::end(); ?>

</div>
