<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

?>
<header>

    <?php
    NavBar::begin(
        [
            'brandLabel' => 'TestUsers',
            'options' => [
                'class' => 'navbar navbar-expand-md navbar-dark bg-dark fixed-top',
            ],
        ]
    );
    echo Nav::widget(
        [
            'options' => ['class' => 'navbar-nav'],
            'items' => [
                ['label' => 'Home', 'url' => ['/user/']],
//            ['label' => 'Books', 'url' => ['/books/push-books']],
//            ['label' => 'New Books', 'url' => ['/books/get-new-books']],
                '<li>'
                . Html::beginForm(['/site/logout'], 'post', ['class' => 'form-inline'])
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'

            ],
        ]
    );
    NavBar::end();
    ?>
</header>