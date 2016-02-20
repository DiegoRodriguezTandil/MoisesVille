<?php

use kartik\helpers\Html;
use kartik\helpers\Enum;

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
                    'label' => 'Agregar Documento',
                    'icon' => 'book',
                    'url' => '#',
                    'type' => Html::TYPE_PRIMARY,
                    'size' => Html::SIZE_SMALL 
                ],
                [
                     'label' => 'Mi perfil',
                     'icon' => 'person',
                     'url' => '#',
                     'type' => Html::TYPE_DANGER,
                     'size' => Html::SIZE_SMALL 
                ],
                [
                    'label' => 'Agregar Objeto',
                    'icon' => 'leaf',
                    'url' => '#',
                    'type' => Html::TYPE_PRIMARY,
                    'size' => Html::SIZE_SMALL 
                ],
                [
                     'label' => 'Autores',
                     'icon' => 'user',
                     'url' => '#',
                     'type' => Html::TYPE_DANGER,
                     'size' => Html::SIZE_SMALL 
                ]
            ]
        ]);
        ?>

        <p><a class="btn btn-lg btn-success" href="http://www.museomoisesville.com.ar/">Sitio Web</a></p>
    </div>

    <div class="body-content">

        <div class="row">
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
        </div>

    </div>
</div>
