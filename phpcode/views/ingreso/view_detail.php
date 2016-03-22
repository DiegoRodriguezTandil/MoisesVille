<?php

use yii\helpers\Html;
use kartik\detail\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Ingreso */

$this->title = 'Ingreso ID Nº '.$model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ingresos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ingreso-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a(Yii::t('app', 'Ficha'), ['print', 'id' => $model->id], ['class' => 'btn btn-info']) ?>
    </p>

   <div class="ingreso-view" id="top">

    <?php 
//    echo DetailView::widget([
//        'model' => $model,
//        'attributes' => [
//            'id',
//            'nombre',
//            'descripcion:ntext',
//
//        ],
//    ]) 
            ?>
    
    <?php 
        $attributes = [
            [
                'group'=>true,
                'label'=>'Información General',
                'rowOptions'=>['class'=>'info']
            ],
            [
                'columns' => [
                    [
                        'value'=>$model->personaDepositanteTexto, 
                        'label'=>'Depositante',
                        'displayOnly'=>true,
                        'valueColOptions'=>['style'=>'width:30%']
                    ],
                    [
                        
                        'value'=>$model->persona->nombre, 
                        'format'=>'raw', 
                        'label'=>'Donante',
                        'valueColOptions'=>['style'=>'width:30%'], 
                        'displayOnly'=>true
                    ],
                ],
            ],
            
            [//columnas materiales    
                'columns' => [
                    [
                        'attribute'=>'fechaEntrada', 
                        'label'=>'Fecha de Entrada',
                        'displayOnly'=>true,                       
                        'valueColOptions'=>['style'=>'width:75%']
                    ],                                  
                ],
            ],  
             [//columnas materiales    
                'columns' => [
                    [
                        'attribute'=>'descripcion', 
                        'label'=>'Descripción',
                        'displayOnly'=>true,
                        'valueColOptions'=>['style'=>'width:75%']
                    ],                                    
                ],
            ],  
            [//columnas materiales    
                'columns' => [
                    [
                        'attribute'=>'observaciones', 
                        'label'=>'Observaciones',
                        'displayOnly'=>true,
                        'valueColOptions'=>['style'=>'width:75%']
                    ],                                    
                ],
            ],           
     
        ];

        
        echo DetailView::widget([
            'model' => $model,
            'attributes' => $attributes,
            'condensed'=>true,
            ]) ;
        ?>
      
</div>
    <h2>Objetos del Ingreso</h2>
    
    <?= GridView::widget([
            'dataProvider' => $acervos,
            'columns' => [
                'nombre',
                'nroInventario',
            ],
        ]);
    ?>
    
    

</div>
