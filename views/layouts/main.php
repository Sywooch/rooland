<?php

/* @var $this \yii\web\View */

/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\assets\HighlightAsset;
use app\components\UserPermissions;

AppAsset::register($this);
HighlightAsset::register($this);

$googleSiteVerification = \Yii::$app->params['googleSiteVerification'];
$yandexVerification = \Yii::$app->params['yandexVerification'];

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php if ($googleSiteVerification) : ?>
        <meta name="google-site-verification" content="<?=\Yii::$app->params['googleSiteVerification'];?>">
    <?php endif; ?>
    <?php if ($yandexVerification) : ?>
        <meta name="yandex-verification" content="<?=\Yii::$app->params['yandexVerification'];?>" />
    <?php endif; ?>
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">

    <div class="header_container">
        <div class="container header">
            <?= Html::a('<img src="/img/rooland-logo.png" alt="rooland" class="header_logo">', Yii::$app->homeUrl); ?>
        </div>
    </div>

    <?php

    NavBar::begin(
        [
            'options'    => [
                'class' => 'navbar-inverse',
            ],
        ]
    );

    $menuItems[] = ['label' => 'Главная', 'url' => ['/post/index']];
    $menuItems[] = ['label' => 'Видео', 'url' => ['/video/index']];
    $menuItems[] = ['label' => 'Форум', 'url' => ['/forum/index']];
    $menuItems[] = ['label' => 'Сделки', 'url' => ['/deals/index']];
    $menuItems[] = ['label' => 'Планета', 'url' => ['/planet/index']];
    $menuItems[] = ['label' => 'Telegram', 'url' => 'https://t.me/roolandorg', 'linkOptions' => ['target' => '_blank']];

    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Регистрация', 'url' => ['/signup']];
        $menuItems[] = ['label' => 'Войти', 'url' => ['/login']];
    } else {

        $menuItems[] = [
            'label' => 'Панель', 'items' => [
                ['label' => 'Мои записи', 'url' => ['/post/my']],
                ['label' => 'Мои видео', 'url' => ['/video/my']],
                ['label' => 'Мои сделки', 'url' => ['/deals/my']],
                ['label' => 'Мои темы форума', 'url' => ['/forum/my']],
                ['label' => 'Профиль', 'url' => ['/user/view', 'id' => \Yii::$app->user->id]],
                Yii::$app->user->can('admin') ? '<li class="divider"></li>' : '',
                ['label' => 'Все записи', 'url' => ['/post/admin'], 'visible' => UserPermissions::canAdminPost()],
                ['label' => 'Все категории', 'url' => ['/category/admin'], 'visible' => UserPermissions::canAdminCategory()],
                ['label' => 'Все пользователи', 'url' => ['/user/admin'], 'visible' => UserPermissions::canAdminUsers()],
                ['label' => 'Все комментарии', 'url' => ['/comment-admin/manage/index'], 'visible' => UserPermissions::canAdminPost()],
                ['label' => 'Все видео', 'url' => ['/video/admin'], 'visible' => UserPermissions::canAdminVideo()],
                ['label' => 'Все сделки', 'url' => ['/deals/admin'], 'visible' => UserPermissions::canAdminDeals()],
                ['label' => 'Все темы форума', 'url' => ['/forum/admin'], 'visible' => UserPermissions::canAdminForum()],
                ['label' => 'Планета', 'url' => ['/planet/admin'], 'visible' => UserPermissions::canAdminPlanet()],
                '<li class="divider"></li>',
                ['label' => 'Выйти (' . Yii::$app->user->identity->username . ')', 'url' => ['/site/logout'], 'linkOptions' => ['data-method' => 'post']]
            ],
        ];

    }

    echo Nav::widget(
        [
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items'   => $menuItems,
        ]
    );

    echo $this->render('partials/search.php');

    NavBar::end();

    ?>

    <div class="container">
        <?= Breadcrumbs::widget(
            [
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]
        ) ?>
        <?= $content ?>
    </div>
</div>

<footer>
    <div class="container footer">
        <p>&copy; <?= date('Y') ?> Сообщество rooland | <a href="/contact">Обратная связь</a></p>
    </div>
</footer>

<?php $this->endBody() ?>

<script>hljs.initHighlightingOnLoad();</script>

<?= $this->render('partials/counter.php'); ?>

</body>
</html>
<?php $this->endPage() ?>
