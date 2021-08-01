<?php

use yii\helpers\Html;
use yii\web\YiiAsset;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Message */

$this->title = $model->subject;
$this->params['breadcrumbs'][] = ['label' => 'Messages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

YiiAsset::register($this);

?>
<div class="message-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'label' => 'From',
                'attribute' => 'from0.username',
            ],
            [
                'label' => 'To',
                'attribute' => 'to0.username',
            ],
            [
                'label' => 'Read at',
                'attribute' => 'read_at',
                'format' => ['date', 'php:d F Y - H:i']
            ],
            'message_text:ntext',
        ],
    ]) ?>

</div>
