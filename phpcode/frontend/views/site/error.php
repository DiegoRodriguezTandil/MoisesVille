<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

$this->title = $name;
?>
<div class="site-error">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>

    <p>
        El error se generado mientras que el servidor procesaba su requerimiento. 
    </p>
    <p>
        Por favor, contactese con el administrador del sistema. Muchas Gracias.
    </p>

</div>
