<?php

use yii\helpers\ArrayHelper;
use kartik\builder\Form;
use kartik\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Acervo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="acervo-form">     
    <?php 
      
        echo Form::widget([
            'model'=>$model,
            'form'=>$form,
            'columns'=> 2,
            'attributes'=>[       // 2 column layout               
                'restauracion'=>['type'=>Form::INPUT_TEXT, 'label'=>'Restauración','options'=>['placeholder'=>'Detalles...']],   
                'fechaRestauracion'=>[
                        'type'=>Form::INPUT_WIDGET, 
                        'widgetClass'=>kartik\datecontrol\DateControl::className(), 
                        'hint'=>'Ingrese Fecha de Restauracióna (dd/mm/aaaa)',
                    ],
            ]
        ]);
       
    ?>

</div>
