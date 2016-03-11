<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\UbicacionExterna */

$this->title = Yii::t('app', 'Create Ubicacion Externa');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ubicacion Externas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ubicacion-externa-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
