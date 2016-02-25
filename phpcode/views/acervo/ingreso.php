<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\tabs\TabsX;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Acervo */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Acervos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="acervo-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?=  TabsX::widget([
    'position' => TabsX::POS_ABOVE,
    'align' => TabsX::ALIGN_LEFT,
        'encodeLabels'=>false,
    'items' => [
        [
            'label' => 'Información <i class="glyphicon glyphicon-list-alt"></i>',
            'content' => $this->render('_form', ['model' => $model]),
            'active' => true,
        ],

        [
            'label' => 'Imaǵenes <i class="glyphicon glyphicon-picture"></i>',
            'content' => $this->render('_formMultimedia', ['model' => $multimedia, 'acervo_id' =>$model->id ]),
            'options' => ['id' => 'myveryownID'],
        ],

    ],
]);
?>


   

</div>
