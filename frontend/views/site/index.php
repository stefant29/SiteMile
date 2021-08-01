<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1><?= Yii::$app->name ?></h1>

        <h3 style="padding-bottom: 3rem">Welcome to our messaging application.</h3>

        <?php if (Yii::$app->user->isGuest) { ?>
            <p>To use our app, you must register first: </p>
            <?= Html::a('Signup', ['/site/signup'], ['class' => 'btn btn-success btn-lg']) ?>

            <p style="padding-top: 3rem">Or if you already have an account, please login: </p>
            <?= Html::a('Login', ['/site/login'], ['class' => 'btn btn-success btn-lg']) ?>
        <?php } else { ?>
            <p>You can find the list of users and your messages dashboard in the navbar, on top of the screen, or you can press on the buttons bellow:</p>

            <?= Html::a('Users', ['/user'], ['class' => 'btn btn-success btn-lg']) ?>

            <?= Html::a('Messages', ['/message'], ['class' => 'btn btn-success btn-lg']) ?>
        <?php } ?>

    </div>

</div>
