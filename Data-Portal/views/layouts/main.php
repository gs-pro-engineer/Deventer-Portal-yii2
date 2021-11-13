<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body>
    <?php $this->beginBody() ?>

    <div class="wrap">
        <?php
        // NavBar::begin([
        //     'brandLabel' => Yii::$app->name,
        //     'brandUrl' => Yii::$app->homeUrl,
        //     'options' => [
        //         'class' => 'navbar-inverse navbar-fixed-top',
        //     ],
        // ]);

        ?>

        <?php
        NavBar::begin([
            'brandLabel' => '<img src="/images/logo.svg" height="28" alt="logo">',
            'brandUrl' => Yii::$app->homeUrl,

        ]);
        echo Nav::widget([

            'options' => ['class' => 'navbar navbar-expand-md navbar-light bg-light'],

            'items' => [
                
                [
                    'label' => 'Home',
                    'url' => ['/site/index']
                ],
                // ['label' => 'About',  'options' => ['class' => ['']],
                //  'url' => ['/site/about']
                // ],
                // ['label' => 'Contact',
                //  'url' => ['/site/contact']
                // ],

                Yii::$app->user->isGuest ? (['label' => 'Login', 'url' => ['/site/login']]) : ([
                        'label' => Yii::$app->user->identity->username,
                        
                        'items' => [
                            ['label' => 'profile', 'url' => ['/site/profile']],
                            //  ['label' => 'change password', 'url' => ['/site/changePassword']],
                            '<div class="dropdown-divider"></div>',

                            [
                                'label' => 'logout',
                                'url' => ['/site/logout'],
                                'linkOptions' => ['data-method' => 'post']
                            ]
                        ]
                    ])


            ],


        ]);
        NavBar::end();
        ?>

        <div class="container">

            <?= Alert::widget() ?>
            <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

            <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>