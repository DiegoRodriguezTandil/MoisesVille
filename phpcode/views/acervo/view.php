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

    <h1><?php //echo Html::encode($this->title) ?>
        <?php echo " Objeto: ".$model->nombre; ?></h1>
    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
        <a href="#fotos" class="btn btn-primary pull-right navigate-top" ><i class="glyphicon glyphicon-picture"></i> Ver imágenes</a>
   
    </p>

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
                        'value' => $model->unidadMedidaDescripcion,                       
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
<div class="acervo-view" id="fotos">
    <br><a href="#top"><i class="glyphicon glyphicon-circle-arrow-up"></i> Top</a>
    <h3>Imágenes del Objeto</h3>
    <div class="fotorama"
        data-fit="scaledown"
        data-width="100%"
        data-ratio="800/600"
        data-minwidth="400"
        data-maxwidth="1000"
        data-minheight="600"
        data-maxheight="100%"
        >

        <?php

        $widget = \kotchuprik\fotorama\Widget::begin([
        'version' => '4.5.2',
        'options' => [
            'nav' => 'thumbs',
        ],
        ]);

        foreach($dataProvider->getModels() as $img)   
             echo Html::img( '@web' .$img->webPath);

        $widget->end();
        ?>
    </div>
</div>