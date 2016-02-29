<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Multimedia');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="multimedia-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php //Html::a(Yii::t('app', 'Nuevo Multimedia'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'imagen',
            'format' => 'html',
            'label' => 'Logo',
            'value' => function ($data) {
                return Html::img('@web/' . $data['webPath'],
                    ['width' => '100px']);
            },
            ],
            ['attribute' => 'objetoName',
            'format' => 'html',            
            'value' => function ($data) {
                $url = Url::toRoute(['acervo/view', 'id' =>$data['objetos_id']]);
                return Html::a(Html::encode($data->objetoName),$url);
            },
            ],        
             'objetoName',      
          //  ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
