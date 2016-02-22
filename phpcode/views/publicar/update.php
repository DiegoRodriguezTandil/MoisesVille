<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Publicar */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Publicar',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Publicars'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="publicar-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
