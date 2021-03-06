<?php

use yii\helpers\Html;
use yii\helpers\HtmlPurifier;

/* @var $this yii\web\View */
/* @var $model app\models\Planet */

?>

<div class="planet-view">

    <h3>
        <?= Html::a($model->title, '/planet/post/' . $model->id); ?>
        <span class="planet-view__permanent_link">
            <?= Html::a('<i class="fa fa-link"></i>', $model->link, ['target' => '_blank', 'rel' => 'nofollow']); ?>
        </span>
    </h3>

    <?= HtmlPurifier::process($model->description); ?>

    <div class="planet-view__footer">
        <i class="fa fa-clock-o"></i> <?= date('d.m.Y → H:i', Html::encode($model->pub_date)); ?>
        <i class="fa fa-user"></i> <?= Html::decode($model->author); ?>
    </div>

</div>
