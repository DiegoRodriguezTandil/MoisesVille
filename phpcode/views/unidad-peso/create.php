<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\UnidadPeso */

$this->title = Yii::t('app', 'Create Unidad Peso');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Unidad Pesos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="unidad-peso-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
