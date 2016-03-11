<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AcervoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Acervos');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="acervo-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Acervo'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'label' => 'N.Orden',
                'value' => 'id',
                'attribute' => 'id',
                'options'=>['width'=>'5%'],
            ],
            'nombre',
            [
                'label' => 'Colecciones',
                'attribute' => 'colecciontextos',
            ],
            [
                'label' => 'Temas',
                'attribute' => 'tematextos',
            ],
            [
                'label' => 'Ubicación',
                'attribute' => 'ubicaciontexto',
            ],
            [
                'class' => 'yii\grid\ActionColumn', 
                'template' => '{view} {update} {delete} {imagen}',
                'buttons' => [
                    'imagen' => function ($url, $model) {
                //    $url =Url::to('@web/'.'index.php?r=multimedia/subir&objeto_id='.$model->id);
                        $url = Url::toRoute(['multimedia/create', 'objetos_id' =>$model->id]);
                        return Html::a('<span class="glyphicon glyphicon-picture"></span>', $url, [
                                    'title' => \Yii::t('yii', 'Agregar Imágenes'),
                                    'data-pjax' => '0',
                        ]);
                    },   
                ],  
            ],
        ],
    ]); ?>

</div>
