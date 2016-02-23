<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\builder\Form;
use yii\grid\GridView;


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
        $form = ActiveForm::begin([
            'type'=>ActiveForm::TYPE_VERTICAL,
            'id'=>$model->formName(),
        ]); 
        
//        echo Form::widget([
//                'model'=>$model,
//                'form'=>$form,
//                'attributes'=>[       
//                    'autoSave'=>[
//                        'type'=>Form::INPUT_HIDDEN, 
//                    ],
//                ]
//            ]);
        echo Html::hiddenInput('Ingreso[autoSave]',$model->autoSave);
        echo Html::hiddenInput('id',$model->id);
        

        
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
        
        echo Html::hiddenInput('action',null, array('id'=>'action'));
    
    ?>  

    <?php
        echo Form::widget([
                'model'=>$model,
                'form'=>$form,
                'columns'=>2,
                'attributes'=>[       // 2 column layout
                    'fechaEntrada'=>[
                        'type'=>Form::INPUT_WIDGET, 
                        'widgetClass'=>kartik\datecontrol\DateControl::className(), 
                        'hint'=>'Ingrese Fecha de Alta (dd/mm/yyyy)',
                    ],
                    'fechaBaja'=>[
                        'type'=>Form::INPUT_WIDGET, 
                        'widgetClass'=>kartik\datecontrol\DateControl::className(), 
                        'hint'=>'Ingrese Fecha de Baja (dd/mm/yyyy)'
                    ],
                   ]
            ]);
    ?>
    
    <div>
        <?= 
            Html::submitButton(
                'Agregar Objeto', 
                [
                    'class' => 'btn btn-primary',
                    'name' => 'newObjectButton',
                    'id' => 'newObjectButton',
                    'value' => 'newObjectButton',
                    'onClick' => "jQuery('#action').val('". \app\controllers\IngresoController::NEW_OBJECT ."')",
                ]
            ); 
        ?>
        <?= 
            GridView::widget([
                'dataProvider' => $dataObject,
                //'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'id',
                    'nombre',
                    'nroInventario',
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{view}{update}{delete}',
                        'buttons' => [
                            'view' => function ($url, $model, $key) {
                                return Html::a(
                                        '<span class="glyphicon glyphicon-eye-opendir"></span>', 
                                        yii\helpers\Url::to(['acervo/viewingreso', 'id'=>$model->id, 'title'=>'Ver Objeto']) 
                                        
                                );
                            },
                            'update' => function ($url, $model, $key) {
                                return Html::a(
                                        '<span class="glyphicon glyphicon-pencil"></span>', 
                                        yii\helpers\Url::to(['acervo/update-ingreso', 'id'=>$model->id, 'title'=>'Modificar Objeto']) 
                                        
                                );
                            },
                            'delete' => function ($url, $model, $key) {
                                return Html::a(
                                        '<span class="glyphicon glyphicon-trash"></span>', 
                                        yii\helpers\Url::to(['acervo/updateingreso', 'id'=>$model->id, 'title'=>'Borrar Objeto']) 
                                );
                            },
                        ],
                    ],
                ],
            ]); 
        ?>        
        
    </div>

    </div>   
    
    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
            <?= Html::submitInput(
                    $model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), 
                    [
                        'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary',
                        'name' => 'saveButton',
                        'id' => 'saveButton',
                        'value' => 'saveButton',
                        'onClick' => "jQuery('#action').val('". \app\controllers\IngresoController::USER_SAVE_INGRESO ."')",
                    ]) 
            ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
