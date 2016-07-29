<?php

use yii\helpers\Html;
//use yii\widgets\DetailView;
use yii\widgets\ListView;
use yii\helpers\Url;
use kartik\detail\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Ingreso */

$this->title = 'Ingreso ID Nº '.$model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ingresos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ingreso-view">

    <div style="width:1000px; float:left; font-size: 14px;  border-style: solid;
    border-bottom: dotted #000;">
        <div style="float:left; width:500px; text-align:left;">
            <h4>Museo Histórico Comunal <br>y de la Colonización Judía<br>"Rabino Aarón N. Goldman"</h4>            
        </div>
        <div style="width:100px; float:right;">
            <p>N° Temporario</p>
        </div>
    </div>
    <h3>Ingreso N°<?= $model->id ?></h3>

    
    <div class="ingreso-view">
        <h4>Información General</h4>
<!--        <div style="width:1000px; float:left; background-color: #c3c3c3">
                <strong>Fecha Entrada  </strong><?=$model->fechaEntrada;?>
        </div>
        <div style="width:1000px; float:left; ">
            <strong>Depositante  </strong><?=$model->personaDepositanteTexto;?>
        </div>           -->
    </div>      
<!--    <div style="width:1000px; float:left; background-color: #cecece">
                <strong>Donante  </strong><?=$model->personaName;?>
    </div>
    <div style="width:1000px; float:left; margin-top:15px;">
                <strong>Descripción  </strong><?=$model->descripcion;?>
    </div>
    <div style="width:1000px; float:left;background-color: #c3c3c3">
                <strong>Observaciones  </strong><?=$model->observaciones;?>
    </div>-->

   
    
    <?php 
        $attributes = [
           
            [
                'columns' => [
                    [
                        'value'=>$model->personaDepositanteTexto, 
                        'label'=>'Depositante',
                        'displayOnly'=>true
                    ],
                ],
            ],
            [//columnas materiales    
                'columns' => [
                    [                          
                        'value'=>$model->personaName,                          
                        'label'=>'Donante',
                        'displayOnly'=>true,
                        'valueColOptions'=>['style'=>'width:75%']
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
    <h3>Objetos del Ingreso</h3>

    <?= GridView::widget([
            'dataProvider' => $acervos,
            'columns' => [
                'nombre',
                'nroInventario',
            ],
        ]);
    ?>
    
    <div style="width:1000px; float:left; margin-top:15px;">
                <strong>Depositante:  </strong>Reconozco que la información de este formulario es correcta y acepto las condiciones abajo específicas
    </div>
    <div style="width:1000px; float:left; margin-top:15px;">
        <strong>Firma</strong>
    </div>

</div>
