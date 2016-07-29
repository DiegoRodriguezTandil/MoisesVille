<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Proyecto';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1>Nuestro Proyecto</h1>

    <p>
       El proyecto desarrollado contempla:
    </p>
    <?= Html::img(Yii::getAlias('@web').'/images/moises_info.png', ['width'=>'780px']);?>

    <!--code><?= __FILE__ ?></code-->
</div>
