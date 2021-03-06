<?php

use yii\helpers\Html;
use \yii\widgets\ListView;
use yii\widgets\Pjax;
use app\assets\VideoAsset;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

VideoAsset::register($this);

$this->title = 'Видео | ' . \Yii::$app->params['siteName'];;


?>

<div class="video-index">
    <h1><i class="fa fa-youtube"></i> Видео</h1>
    <ul class="video-index-filter">
        <li><?= Html::a('<i class="fa fa-clock"></i>Новые', '/video') ?></li>
        <li><?= Html::a('<i class="fa fa-eye"></i>Популярные', '/video/hits') ?></li>
        <li><?= Html::a('<i class="fa fa-comments"></i>Обсуждаемые', '/video/comments') ?></li>
        <li><?= Html::a('<i class="far fa-clock"></i>Старые', '/video/old') ?></li>
    </ul>
    <div class="video-index-list">
        <?php Pjax::begin(); ?>
            <?= ListView::widget(
                [
                    'dataProvider' => $dataProvider,
                    'emptyText' => 'Видео не найдены.',
                    'itemView' => '_view',
                    'layout' => "{items}{pager}",
                ]
            ); ?>
        <?php Pjax::end(); ?>
    </div>
</div>
