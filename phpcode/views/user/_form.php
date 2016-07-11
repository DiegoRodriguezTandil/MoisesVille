<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;


/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php 
        $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL]);
        echo Form::widget([
            'model'=>$model,
            'form'=>$form,
            'columns'=>2,
            'attributes'=>[       // 2 column layout
                'firstName'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Nombre...']],
                'lastName'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Apellido...']]
            ]
        ]);

        echo Form::widget([
                'model'=>$model,
                'form'=>$form,
                'columns'=>2,
                'attributes'=>[       // 2 column layout
                    'username'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Usuario...']],
                    'password'=>['type'=>Form::INPUT_PASSWORD, 'options'=>['placeholder'=>'Contraseña...']]
                ]
            ]);
    ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
