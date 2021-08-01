<?php

use common\models\Message;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\web\YiiAsset;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\MessageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Messages';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="message-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Message', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => ['class' => 'table table-bordered'],
        'rowOptions' => function (Message $message, $key, $index, $grid) {
            return [
                'class' => 'has-tooltip' . ($message->from === Yii::$app->user->id ? ' bg-warning text-dark' : ' bg-success text-white'),
                'title' => $message->from === Yii::$app->user->id ? 'Sent' : 'Received',
                'data-placement' => 'right',
            ];
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'label' => 'From',
                'attribute' => 'from0.username',
            ],
            [
                'label' => 'To',
                'attribute' => 'to0.username',
            ],
            'subject',
            'message_text:ntext',
            [
                'label' => 'Read at',
                'attribute' => 'read_at',
                'format' => ['date', 'php:d F Y - H:i']
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}',
            ]
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
