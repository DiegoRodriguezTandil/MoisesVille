<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
//use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
//use kartik\helpers\Html;
//use yii\bootstrap\Popover;
use kartik\nav\NavX;
use mdm\admin\components\MenuHelper;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php //$content = '<p class="text-justify">' .
    //'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.' . 
   // '</p>';
    ?>
    <?php /*
    NavBar::begin([
        'brandLabel' => 'Museo Moises Ville',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
          //  ['label' => 'Home', 'url' => ['/site/index']],
          //  ['label' => 'About', 'url' => ['/site/about']],
          //  ['label' => 'Contact', 'url' => ['/site/contact']],    
            ['label' =>  Yii::t('app', 'Inicio'), 'url' => ['/site/index']],
            ['label' => Yii::t('app','Ingreso'), 'url' => ['/ingreso']],
            ['label' => Yii::t('app','Acervo'), 'url' => ['/acervo']],
            ['label' => Yii::t('app','Usuarios'), 'url' => ['/user']],                    
            ['label' => Yii::t('app','Configuración'), 'url' => ['/site/contacto'],
                'items'=>array(
                        array('label'=>'Colecciones', 'url'=>array('/coleccion')),
                        array('label'=>'Temas', 'url'=>array('/tema')),
                        array('label'=>'Tipos de Acervo', 'url'=>array('/tipo-acervo')),
                        array('label'=>'Multimedia', 'url'=>array('/multimedia')),
                      ),
            ],
            ['label' => Yii::t('app','Contacto'), 'url' => ['#']],
            Yii::$app->user->isGuest ?
                ['label' => 'Login', 'url' => ['/site/login']] :
                [
                    'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                    'url' => ['/site/logout'],
                    'linkOptions' => ['data-method' => 'post']
                ],
        ],
    ]);
    NavBar::end();
     * 
     */
    ?>
    
    <?php
//    $logo1 = Html::img(Yii::getAlias('@web').'/images/museomoisesville.png', ['height'=>'30']);
//    $logo = Html::img('@web/gestion.png', ['width'=>'300']);
    NavBar::begin([
        'brandLabel' => '<img src="' . \Yii::getAlias('@web').'/images/museomoisesville.png' . ' " width="8%" style="float:left;margin-top:-7px; margin-right:10px;"><img src="' .\Yii::getAlias('@web').'/images/gestion.jpg'. ' " width="320" style="float:left;">',
        'brandUrl' => 'index.php?r=site/index',
        'brandOptions' => ['title' => 'Gestión de Colecciones', 'style'=>'width:auto'],
        'options' => [
            'id' => 'top-menu',
            'class' => 'navbar-inverse',
        ],
        'innerContainerOptions' => ['class'=>'kv-container'],
        'renderInnerContainer' => true
    ]);
    // if (!Yii::$app->user->isGuest )
    //     {        
    //         $itemsLeft = [
    //             ['label' => 'Inicio','url' => ['/site/index']],        
    //             ['label' => Yii::t('app','Ingresos'), 'url' => ['/ingreso'],
    //                         'items'=>array(
    //                             array('label'=>'Listado de Ingresos', 'url'=>array('/ingreso')),
    //                             array('label'=>'Nuevo Ingreso', 'url'=>array('/ingreso/create')),                                
    //                           ),],
    //                 ['label' => Yii::t('app','Acervo'), 'url' => ['/acervo'],
    //                             'items'=>array(
    //                             array('label'=>'Listado de Acervos', 'url'=>array('/acervo')),
    //                         //    array('label'=>'Nuevo Acervo', 'url'=>array('/acervo/create')),                                
    //                           ),],
    //                 ['label' => Yii::t('app','Personas'), 'url' => ['/persona']],                    
    //                 ['label' => Yii::t('app','Configuración'), 'url' => ['/site/contacto'],
    //                     'items'=>array(
    //                             array('label'=>'Usuarios', 'url'=>array('/user')),
    //                             array('label'=>'Colecciones', 'url'=>array('/coleccion')),
    //                             array('label'=>'Temas', 'url'=>array('/tema')),
    //                             array('label'=>'Tipos de Acervo', 'url'=>array('/tipo-acervo')),
    //                             array('label'=>'Multimedia', 'url'=>array('/multimedia')),
    //                           ),
    //                 ],
    //                // ['label' => Yii::t('app','Contacto'), 'url' => ['#']],
    //         ];
    //         echo NavX::widget(['options' => ['class' => 'navbar-nav'], 'items' => $itemsLeft]);
    //     }
    echo NavX::widget(['options' => ['class' => 'navbar-nav'], 'items' => MenuHelper::getAssignedMenu(Yii::$app->user->id)]);

    $itemsRight = [
       // ['label' => Yii::t('app','Cuenta'), 'url' => ['#']],
            Yii::$app->user->isGuest ?
                ['label' => 'Ingresar', 'url' => ['/site/login']] :
                [
                    'label' => 'Salir (' . Yii::$app->user->identity->username . ')',
                    'url' => ['/site/logout'],
                    'linkOptions' => ['data-method' => 'post']
                ],
    ];

    echo NavX::widget(['options' => ['class' => 'navbar-nav navbar-right'], 'items' => $itemsRight]);
    NavBar::end();
    ?>
    
    <?php foreach (Yii::$app->session->getAllFlashes() as $message): ?>
        <?php
        echo \kartik\widgets\Growl::widget([
            'type' => (!empty($message['type'])) ? $message['type'] : 'danger',
            'title' => (!empty($message['title'])) ? Html::encode($message['title']) : 'Moisés Ville Museo',
            'icon' => (!empty($message['icon'])) ? $message['icon'] : 'fa fa-info',
            'body' => (!empty($message['message'])) ? Html::encode($message['message']) : ' ',
            'showSeparator' => true,
            'delay' => 1, //This delay is how long before the message shows
            'pluginOptions' => [
                'delay' => (!empty($message['duration'])) ? $message['duration'] : 5000, //This delay is how long the message shows for
                'placement' => [
                    'from' => (!empty($message['positonY'])) ? $message['positonY'] : 'top',
                    'align' => (!empty($message['positonX'])) ? $message['positonX'] : 'right',
                ]
            ]
        ]);
        ?>
    <?php endforeach; ?>    

    <div class="container">
        <div class="col-sm-12">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= $content ?>
        </div>
    </div>
</div>
<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Museo Histórico Comunal y de la Colonización Judía
"Rabino Aarón H. Goldman" - <?= date('Y') ?></p>

        <p class="pull-right"><a href="http://www.qwavee.com">Qwavee</a></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
