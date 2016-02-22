<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Organizacion */

$this->title = Yii::t('app', 'Create Organizacion');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Organizacions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="organizacion-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
