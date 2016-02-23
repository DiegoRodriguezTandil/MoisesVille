<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Publicar */

$this->title = Yii::t('app', 'Create Publicar');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Publicars'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="publicar-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
