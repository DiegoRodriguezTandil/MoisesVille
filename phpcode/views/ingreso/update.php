<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Ingreso */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Ingreso',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ingresos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="ingreso-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'btnSave' => $btnSave,
        'btnNewObject' => $btnNewObject,
        'btnNewPersona'=> $btnNewPersona,        
        'dataObject' => $dataObject,        
    ]) ?>

</div>
