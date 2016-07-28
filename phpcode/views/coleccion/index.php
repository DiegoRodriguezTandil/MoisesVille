<?php

use yii\helpers\Html;
use yii\grid\GridView;
use mdm\admin\components\Helper;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Coleccions');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="coleccion-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>

    <!--HELPER YII2-ADMIN-->
       <?php if(Helper::checkRoute('create')){
            echo Html::a(Yii::t('app','Nueva coleccion'),['create'], ['class' => 'btn btn-success']);
        }?>
   </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'nombre',

            [
                'class' => 'yii\grid\ActionColumn',
             'template' => Helper::filterActionColumn('{view}{delete}{update}'),
            ],
        ],
    ]); ?>

</div>
