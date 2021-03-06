<?php

use yii\helpers\Html;
use yii\grid\GridView;

use mdm\admin\components\Helper;


/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create User'), ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('<i class="fa glyphicon glyphicon-print"></i> Imprimir', ['/user/print'], [
                'class'=>'btn btn-info', 
                'target'=>'_blank', 
                'data-toggle'=>'tooltip', 
                'title'=>'  Genera un archivo PDF en otra ventana.'
            ]);
        ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'username',
            'firstName',
            'lastName',
            'email:email',
             [
            'class' => 'yii\grid\ActionColumn',
             'template' => Helper::filterActionColumn('{view}{delete}{update}'),
            ],
        ],
    ]); ?>

</div>
