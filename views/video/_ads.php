<?php

    use app\models\User;

    $adsVisibility = $model->user->ads_visibility;

    $show =  $adsVisibility === User::VISIBILITY_REGISTER_USER_ONLY
        && Yii::$app->user->isGuest
        || $adsVisibility === User::VISIBILITY_ALL_USERS ? true : false;

    $aadsComId = $model->user->aads_com_id ?? '';

?>

<?= $this->render('/partials/banner'); ?>

<?php if (!empty($aadsComId) && $show) : ?>

    <hr>

    <div class="author_support_hint">
        У вас включён блокировщик рекламы (Adblocker, Adblocker Plus, uBlock).<br>
        Если вы хотите поддержать автора данного видео, пожалуйста выключите его!
    </div>

    <iframe data-aa='<?= $aadsComId ?>' src='//ad.a-ads.com/<?= $aadsComId; ?>?size=120x60' class='author_support'></iframe>

    <hr>

<?php endif; ?>
