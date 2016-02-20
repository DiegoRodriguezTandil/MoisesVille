<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Coleccion */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Coleccion',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Coleccions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="coleccion-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
