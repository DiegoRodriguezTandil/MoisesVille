<?php

use yii\helpers\Html;
//use yii\bootstrap\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use kartik\builder\Form;

/* @var $this yii\web\View */
/* @var $model app\models\Ingreso */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ingreso-form">

    <?php /* $form = ActiveForm::begin([
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
                ]); */
        $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL]); 
        echo Form::widget([
                'model'=>$model,
                'form'=>$form,
                'columns'=>2,
                'attributes'=>[       // 2 column layout
                    'descripcion'=>[
                        'type'=>Form::INPUT_TEXTAREA, 
                        'options'=>['placeholder'=>'Ingrese Descripción...']
                    ],
                    'observaciones'=>[
                        'type'=>Form::INPUT_TEXTAREA, 
                        'options'=>['placeholder'=>'Ingrese Observaciones...']
                    ],
                   ]
            ]);

        $dataPost=ArrayHelper::map(\app\models\User::find()->asArray()->all(), 'id', 'username');
        echo $form->field($model, 'user_id')
        ->dropDownList(
            $dataPost,
            ['prompt' => '-Usuario-'],
            ['id'=>'user_id']
        );
    
    ?>  

    <?php
        echo Form::widget([
                'model'=>$model,
                'form'=>$form,
                'columns'=>2,
                'attributes'=>[       // 2 column layout
                    'fechaEntrada'=>[
                        'type'=>Form::INPUT_WIDGET, 
                        'widgetClass'=>'\kartik\widgets\DatePicker', 
                        'hint'=>'Ingrese Fecha de Alta (dd/mm/yyyy)'
                    ],
                    'fechaBaja'=>[
                        'type'=>Form::INPUT_WIDGET, 
                        'widgetClass'=>'\kartik\widgets\DatePicker', 
                        'hint'=>'Ingrese Fecha de Baja (dd/mm/yyyy)'
                    ],
                   ]
            ]);
    ?>

    </div>   
    
    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
             <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
