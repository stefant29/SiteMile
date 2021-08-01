<?php

use common\models\Message;
use common\models\User;
use yii\helpers\Html;

/* @var $message Message */
/* @var $user User */

$verifyLink = Yii::$app->urlManager->createAbsoluteUrl(['message/view', 'id' => $message->id]);

?>

Hello <?= Html::encode($user->username) ?>,

You have received a new message. Click on the link below to read it:

<?= $verifyLink ?>

