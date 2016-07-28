<?php

use yii\bootstrap\NavBar;
use yii\bootstrap\Nav;
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */

list(,$url) = Yii::$app->assetManager->publish('@mdm/admin/assets');
$this->registerCssFile($url.'/main.css');
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
        <?php $this->beginBody() ?>
        <?php
        NavBar::begin([
            'brandLabel' => false,
            'options' => ['class' => 'navbar-inverse navbar-fixed-top'],
        ]);

        if (!empty($this->params['top-menu']) && isset($this->params['nav-items'])) {
            echo Nav::widget([
                'options' => ['class' => 'nav navbar-nav'],
                'items' => $this->params['nav-items'],
            ]);
        }

        echo Nav::widget([
            'options' => ['class' => 'nav navbar-nav navbar-right'],
            'items' => $this->context->module->navbar,
         ]);
        NavBar::end();
        ?>

        <div class="container">
            <?= $content ?>
        </div>

    <footer class="footer" style="background-color:#cecece;">
        <div class="container" >
            <p class="pull-left">&copy; Museo Histórico Comunal y de la Colonización Judía
    "Rabino Aarón H. Goldman" - <?= date('Y') ?></p>

            <p class="pull-right">Desarrollado por <a href="http://www.qwavee.com"><img width="100"src="./images/logo-qwavee.png"></a></p>
        </div>
    </footer>

        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
