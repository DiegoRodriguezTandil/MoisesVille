<?php

use kartik\helpers\Html;
use kartik\helpers\Enum;
use kartik\tabs\TabsX;
use yii\helpers\Url;

/* @var $this yii\web\View */

$this->title = 'Museo Moises Ville';
?>
<div class="site-index">

    <div class="jumbotron">
        <!--h1>Museo Moises Ville</h1>

        <p class="lead">Museo Histórico Comunal y de la Colonización Judía</p-->
        
        <?php
        echo Html::jumbotron([
            'heading' => 'Museo Moises Ville', 
            'body' => 'Museo Histórico Comunal y de la Colonización Judía',
            'buttons' => [
                [
                    'label' => 'Agregar Ingreso',
                    'icon' => 'book',
                    'url' => \yii\helpers\Url::to(['/ingreso/create']),
                    'type' => Html::TYPE_PRIMARY,
                    'size' => Html::SIZE_MEDIUM,
                    'styles' => 'padding:0;'
                ],               
                [
                    'label' => 'Agregar Objeto',
                    'icon' => 'leaf',
                    'url' => \yii\helpers\Url::to(['/acervo/create']),
                    'type' => Html::TYPE_PRIMARY,
                    'size' => Html::SIZE_MEDIUM 
                ],
//                [
//                     'label' => 'Autores',
//                     'icon' => 'user',
//                     'url' => '#',
//                     'type' => Html::TYPE_PRIMARY,
//                     'size' => Html::SIZE_MEDIUM 
//                ],
//                [
//                     'label' => 'Mi perfil',
//                     'icon' => 'info-sign',
//                     'url' => '#',
//                     'type' => Html::TYPE_PRIMARY,
//                     'size' => Html::SIZE_MEDIUM 
//                ],
            ]
        ]);
        ?>
    </div>

    <div class="body-content">

<!--        <div class="row">
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/forum/">Yii Forum &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>
            </div>
        </div>-->

    </div>
</div>
