<?php

use common\models\User;
use yii\helpers\Html;

/* @var $message \common\models\Message */
/* @var $user User */

$verifyLink = Yii::$app->urlManager->createAbsoluteUrl(['message/view', 'id' => $message->id]);
?>

<div class="verify-email">
    <p>Hello <?= Html::encode($user->username) ?>,</p>

    <p>You have received a new message. Click on the link below to read it:</p>

    <p><?= Html::a(Html::encode($verifyLink), $verifyLink) ?></p>
</div>
