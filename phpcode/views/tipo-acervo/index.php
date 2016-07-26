<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

use kartik\widgets\ActiveForm;
use kartik\builder\Form;

use mdm\admin\components\Helper;


/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Tipo Acervos');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-acervo-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
    
    <!--HELPER YII2-ADMIN-->
       <?php if(Helper::checkRoute('create')){
            echo Html::a(Yii::t('app','Crear Tipo Acervo'),['create'], ['class' => 'btn btn-success']);
        }?>
    </p>
    

    <?= GridView::widget([ 
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           ///'id',
            'descripcion',
            'tipoAcervoPadre',
      /*      [
                'attribute' => 'tipoAcervo_id',
                'value' => function($dataProvider) {
                                if ($dataProvider['tipoAcervo_id'] == "") return '';
                                else return $dataProvider->tipoAcervoPadre;
			       
			    },
               // 'value' => 'tipoAcervo.descripcion'
            ],*/
            [
            'class' => 'yii\grid\ActionColumn',
             'template' => Helper::filterActionColumn('{view}{delete}{update}'),
            ],
        ],
    ]); 

    
?>

</div>
