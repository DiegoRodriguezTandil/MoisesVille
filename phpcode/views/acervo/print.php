<?php
use kotchuprik\fotorama;
use yii\helpers\Html;
//use yii\widgets\DetailView;
use yii\widgets\ListView;
use yii\helpers\Url;
use kartik\detail\DetailView;
use bupy7\gridifyview\GridifyView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Acervo */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Acervos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="acervo-view" id="top">

    <div style="width:1000px; float:left; font-size: 14px;  border-style: solid;
    border-bottom: dotted #000;">
        <div style="width:200px; float:left;">
            <p>N° de Registro</p><?=$model->nroInventario;?>
        </div>
        <div style="float:left; width:300px; text-align:center;">
            <h4>Museo Histórico Comunal <br>y de la colonización judía<br>"Rabino Aarón N. Goldman"</h4>            
        </div>
        <div style="width:100px; float:right;">
            <p>N° de Orden</p><?=$model->id;?>
        </div>
    </div>
    <h4><?php //echo Html::encode($this->title) ?>
        <?php echo " Objeto: ".$model->nombre; ?></h4>
    
    <?php 
        $attributes = [
            [
                'group'=>true,
                'label'=>'Información General',
                'rowOptions'=>['class'=>'info'],
                'valueColOptions'=>['style'=>'border-style: hidden;']
            ],
            [
                'columns' => [
                    [
                        'attribute'=>'id', 
                        'label'=>'Nro. Acervo',
                        'displayOnly'=>true,
                        'valueColOptions'=>['style'=>'width:30%']
                    ],
                    [
                        'attribute'=>'nombre', 
                        'format'=>'raw', 
                    //    'value'=>'<kbd>'.$model->nombre.'</kbd>',
                        'value'=>$model->nombre,
                        'valueColOptions'=>['style'=>'width:30%'], 
                        'displayOnly'=>true
                    ],
                ],
            ],
            [
                'group'=>true,
                'label'=>'Características',
                'rowOptions'=>['class'=>'info']
            ],
            [
                'columns' => [
                    [
                        'attribute'=>'tipoAcervo_id', 
                        'label'=>'Tipo Acervo',
                        'displayOnly'=>true,
                        'value'=> $model->tipoAcervo->descripcion,
                        'valueColOptions'=>['style'=>'width:15%']
                    ],
                    [
                        'attribute'=>'copia_id', 
                        'label'=>'Tipo de Copia',
                        'displayOnly'=>true,
                        'value'=> $model->copia->nombre,                    
                       // 'valueColOptions'=>['style'=>'width:20%'], 
                        'displayOnly'=>true
                    ],
                    [
                        'attribute'=>'lugarprocac', 
                        'label'=>'Lugar de Procedencia',
                        'format'=>'raw',                       
                        'valueColOptions'=>['style'=>'width:15%'], 
                        'displayOnly'=>true
                    ],                    
                ],
            ],
            [//columnas materiales    
                'columns' => [
                    [
                        'attribute'=>'material', 
                        'label'=>'Material',
                        'displayOnly'=>true,
//                        'value'=> $model->tipoAcervo->descripcion,
                        'valueColOptions'=>['style'=>'width:15%']
                    ],
                    [
                        'attribute'=>'forma', 
                        'label'=>'Forma',
                        'displayOnly'=>true,
//                        'value'=> $model->copia->nombre,                    
                       // 'valueColOptions'=>['style'=>'width:20%'], 
                        'displayOnly'=>true
                    ],
                    [
                        'attribute'=>'color', 
                        'label'=>'Color',
                        'format'=>'raw',                       
                        'valueColOptions'=>['style'=>'width:15%'], 
                        'displayOnly'=>true
                    ],                    
                ],
            ], 
            [//columnas materiales    
                'columns' => [
                    [
                        'attribute'=>'fechaIngreso', 
                        'label'=>'Fecha Ingreso',
                        'displayOnly'=>true,
//                        'value'=> $model->tipoAcervo->descripcion,
                        'valueColOptions'=>['style'=>'width:15%']
                    ],
                    [
                        'value'=>$model->clasificacionGenericaTexto, 
                        'label'=>'Clasificación Genérica',
                        'displayOnly'=>true,
//                        'value'=> $model->copia->nombre,                    
                        'valueColOptions'=>['style'=>'width:20%'], 
                        'displayOnly'=>true
                    ],
                    [
                        'attribute'=>'descEpoca', 
                        'label'=>'Época',
                        'format'=>'raw',                       
                        'valueColOptions'=>['style'=>'width:15%'], 
                        'displayOnly'=>true
                    ],                    
                ],
            ], 
            [
                'group'=>true,
                'label'=>'Ubicación',
                'rowOptions'=>['class'=>'info']
            ],
            [//columnas Ubicación    
                'columns' => [
                    [
                        'attribute'=>'ubicacion_id', 
                        'label'=>'Ubicación',
                        'displayOnly'=>true,
                        'value'=> $model->ubicacion->nombre,
                        'valueColOptions'=>['style'=>'width:15%']
                    ],
                    [
                        'attribute'=>'descUbicacion', 
                        'label'=>'Detalles Ubicación',
                        'displayOnly'=>true,
//                        'value'=> $model->copia->nombre,                    
                       // 'valueColOptions'=>['style'=>'width:20%'], 
                        'displayOnly'=>true
                    ],                                       
                ],
            ],
            [
                'group'=>true,
                'label'=>'Dimensiones',
                'rowOptions'=>['class'=>'info']
            ],
            [//columnas dimensiones    
                'columns' => [
                    [
                        'attribute'=>'ancho', 
                        'displayOnly'=>true,
                    ],                    
                   [
                        'attribute'=>'alto',       
                        'displayOnly'=>true,
                    ],  
                    [
                        'attribute'=>'largo', 
                        'label'=>'Profundidad',
                        'displayOnly'=>true,
//                       
                    ], 
                    [
                        'attribute'=>'unidadMedida_id', 
                        'label'=>'Unidad Medida',
                        'value' => $model->unidadMedidaDescripcion,                       
                        'displayOnly'=>true,                      
                    ], 
                ],
            ],
            [//columnas dimensiones    
                'columns' => [
                    [
                        'attribute'=>'diametroInterno',                         
                        'displayOnly'=>true,
                        
                    ],                    
                    [
                        'attribute'=>'diametroExterno',                         
                        'displayOnly'=>true,
                        
                    ],  
                    [
                        'attribute'=>'peso', 
                        'displayOnly'=>true,
                        
                    ], 
                    [
                        'attribute'=>'unidadPeso_id',                         
                        'value' => $model->unidadPesoDescripcion,                       
                        'displayOnly'=>true,
                        
                    ], 
                ],
            ],
            [
                'group'=>true,
                'label'=>'Características',
                'rowOptions'=>['class'=>'info']
            ],
            [//columnas materiales    
                'columns' => [
                    [
                        'attribute'=>'caracteristicas', 
                        'label'=>'Características',
                        'displayOnly'=>true,
//                        'value'=> $model->tipoAcervo->descripcion,
                        'valueColOptions'=>['style'=>'width:30%']
                    ],                    
                   [
                        'attribute'=>'notas', 
                        'label'=>'Notas',
                        'displayOnly'=>true,
//                        'value'=> $model->tipoAcervo->descripcion,
                        'valueColOptions'=>['style'=>'width:30%']
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
    
    <div style="float:left; font-size: 14px; margin: 10px;  ">
        <?php if($dataProvider->getTotalCount() > 0) { ?>
        <strong>Fotografías:</strong>   
        <?php } ?>
        <?php foreach($dataProvider->getModels() as $img) {  ?>
                <div style="width:400px; float:left; font-size: 14px; margin: 10px;  ">
                    <?php   echo Html::img( '@web' .$img->webPath); 
                            echo '</div>';
             } ?>
                    
    </div>
    
    <div style="width:1000px; float:left; font-size: 14px; margin-bottom: 10px;">
        <div style="float:left; width: 400px;"><br>
            <strong>Firma: </strong>
        </div> 
        <div style="float:right; width: 200px;">
            <strong>Fecha: ......../......../........
        </div>                 
    </div>
</div>