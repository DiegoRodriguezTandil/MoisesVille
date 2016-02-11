<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Colecciones */

$this->title = 'Crear Colecciones';
$this->params['breadcrumbs'][] = ['label' => 'Colecciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="colecciones-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
