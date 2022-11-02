<?php

/** @var \yii\web\View $this */
/** @var string $content */

use common\widgets\Alert;
use frontend\assets\AppAsset;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header>
    <?php
    NavBar::begin([
        'brandLabel' => 'Chatty Bakery Shop',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-expand-md navbar-dark bg-secondary fixed-top',
        ],
    ]);
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
    }else if(Yii::$app->user->can('employee') || Yii::$app->user->can('Admin')){
        $menuItems = [
            ['label' => 'Home', 'url' => ['/product/index']],
            ['label' => 'Rates', 'url' => ['/product/rates']],
        ];
    }else{
        $menuItems = [
            ['label' => 'Home', 'url' => ['/site/index']],
            ['label' => 'Cart', 'url' => ['/order-cart/index']],
            ['label' => 'Rate Us', 'url' => ['/site/rate']],
        ];
    }

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav me-auto mb-2 mb-md-0'],
        'items' => $menuItems,
    ]);
    if (Yii::$app->user->isGuest) {
        echo Html::tag('div',Html::a('Login',['/site/login'],['class' => ['btn btn-success']]),['class' => ['d-flex']]);
    } else{
        echo Html::beginForm(['/site/logout'], 'post', ['class' => 'd-flex'])
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-danger']
            )
            . Html::endForm();
    }
    NavBar::end();
    ?>
</header>

<main role="main" class="flex-shrink-0">
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer class="footer mt-auto py-3 text-muted">
    <div class="container">
        <p class="float-start">&copy; ฉัตรมงคล สอนจันทร์ , อธิคม เจริญสุข</p>
        <p class="float-end">Website นี้เป็นส่วนหนึ่งของวิชา Web Application และ Database</p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage();
