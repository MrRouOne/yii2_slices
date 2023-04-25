<?php

use app\models\Category;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Product $model */

\yii\web\YiiAsset::register($this);
?>
<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Отредактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'category_id',
                'value' =>Category::find()->where(['id'=>$model->category_id])->one()->name,
            ],
            'name',
            [
                'attribute' => 'image',
                'value' => '../' . $model->image,
                'format' => ['image', ['width' => '100', 'height' => '100']],
            ],
            'price',
            'country',
            'year',
            'model',
            'created_at',
        ],
    ]) ?>

</div>
