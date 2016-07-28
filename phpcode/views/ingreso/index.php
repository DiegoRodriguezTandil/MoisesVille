<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use mdm\admin\components\Helper;


/* @var $this yii\web\View */
/* @var $searchModel app\models\IngresoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Listado de Ingresos');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ingreso-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>

       <?php if(Helper::checkRoute('create')){
            echo Html::a(Yii::t('app','Crear Ingreso'),['create'], ['class' => 'btn btn-success']);
        }?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'descripcion',
            'personaName',
            [
                'attribute'=>'fechaEntrada',   
                'format' => ['date', 'php:d/m/Y'], 
            ],
            'observaciones',
//            [
//                'attribute'=>'fechaBaja',   
//                'format' => ['date', 'php:d/m/Y'], 
//            ],
                       
           ['class' => 'yii\grid\ActionColumn', 
         'template' => Helper::filterActionColumn('{view}{delete}{update}{imagen}'),]
        ],
    ]);?>
   

</div>
