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
                    'label' => 'Agregar Documento',
                    'icon' => 'book',
                    'url' => '#',
                    'type' => Html::TYPE_PRIMARY,
                    'size' => Html::SIZE_MEDIUM,
                    'styles' => 'padding:0;'
                ],               
                [
                    'label' => 'Agregar Objeto',
                    'icon' => 'leaf',
                    'url' => '#',
                    'type' => Html::TYPE_PRIMARY,
                    'size' => Html::SIZE_MEDIUM 
                ],
                [
                     'label' => 'Autores',
                     'icon' => 'user',
                     'url' => '#',
                     'type' => Html::TYPE_PRIMARY,
                     'size' => Html::SIZE_MEDIUM 
                ],
                [
                     'label' => 'Mi perfil',
                     'icon' => 'info-sign',
                     'url' => '#',
                     'type' => Html::TYPE_PRIMARY,
                     'size' => Html::SIZE_MEDIUM 
                ],
                [
                     'label' => 'Organización',
                     'icon' => 'home',
                     'url' => Url::to(['/organizacion']),
                     'type' => Html::TYPE_PRIMARY,
                     'size' => Html::SIZE_MEDIUM 
                ]
            ]
        ]);
        ?>

        <!--p><a class="btn btn-lg btn-success" href="http://www.museomoisesville.com.ar/">Sitio Web</a></p-->
    </div>

    <div class="body-content">

        <?php
        
        /*
        $items = [
    [
        'label'=>'<i class="glyphicon glyphicon-home"></i> Home',
        'content'=>'jlksjalksd',
        'active'=>true,
        'linkOptions'=>['data-url'=>Url::to(['/site/fetch-tab?tab=1'])]
    ],
    [
        'label'=>'<i class="glyphicon glyphicon-user"></i> Profile',
        'content'=>'hkjhk',
        'linkOptions'=>['data-url'=>Url::to(['/site/fetch-tab?tab=2'])]
    ],
    [
        'label'=>'<i class="glyphicon glyphicon-list-alt"></i> Dropdown',
        'items'=>[
             [
                 'label'=>'<i class="glyphicon glyphicon-chevron-right"></i> Option 1',
                 'encode'=>false,
                 'content'=>'$content3',
                 'linkOptions'=>['data-url'=>Url::to(['/site/fetch-tab?tab=3'])]
             ],
             [
                 'label'=>'<i class="glyphicon glyphicon-chevron-right"></i> Option 2',
                 'encode'=>false,
                 'content'=>'$content4',
                 'linkOptions'=>['data-url'=>Url::to(['/site/fetch-tab?tab=4'])]
             ],
        ],
    ],
];
// Ajax Tabs Above
echo TabsX::widget([
    'items'=>$items,
    'position'=>TabsX::POS_ABOVE,
    'encodeLabels'=>false
]);*/

?>
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
