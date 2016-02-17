<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Multimedia');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="multimedia-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Nuevo Multimedia'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'path',
            'webPath',
            'tipoMultimedia_id',
            'objetos_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
