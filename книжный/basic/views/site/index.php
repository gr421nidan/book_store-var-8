<?php

/** @var yii\web\View $this */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent mt-5 mb-5">
        <h1 class="display-4">Книжный магазин!</h1>
        <?php if (Yii::$app->user->isGuest): ?>
            <p class="lead">Хотите купить книги?</p>
            <p><a class="btn btn-lg btn-success" href="<?= yii\helpers\Url::to(['site/login']) ?>">Купить книги</a></p>
        <?php elseif (!Yii::$app->user->isGuest && Yii::$app->user->identity->isAdmin()): ?>
            <p><a class="btn btn-lg btn-success" href="<?= yii\helpers\Url::to(['book/index']) ?>">Посмотреть доступные книги</a></p>
        <?php else: ?>
            <p class="lead">Хотите купить книги?</p>
            <p><a class="btn btn-lg btn-success" href="<?= yii\helpers\Url::to(['book/index']) ?>">Посмотреть доступные книги</a></p>
        <?php endif; ?>


    </div>

</div>
