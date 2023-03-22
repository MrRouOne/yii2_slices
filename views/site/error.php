<?php

/** @var yii\web\View $this */
/** @var string $name */
/** @var string $message */
/** @var Exception$exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="site-error d-flex flex-column justify-content-center align-items-center">

    <h1 style="font-size: 10rem"><?= Yii::$app->response->statusCode ?></h1>

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>


</div>
