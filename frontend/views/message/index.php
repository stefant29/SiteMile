<?php

use common\models\Message;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\grid\GridView;
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
        <span style="display:flex; justify-content:flex-end; width:100%; padding:0;">
            <?= Html::a('Create Message', ['create'], ['class' => 'btn btn-success']) ?>
        </span>
    </p>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => ['class' => 'table table-bordered'],
        'layout' => "{items}\n{pager}\n<span style='display:flex; justify-content:flex-end'>{summary}</span>",
        'rowOptions' => function (Message $message, $key, $index, $grid) {
            return [
                'class' => $message->from === Yii::$app->user->id ? 'bg-warning text-dark' : 'bg-success text-white',
            ];
        },
        'summary' => Yii::t("app", 'Showing messages {range} of {total}.', [
            'range' => '<b>{begin}-{end}</b>',
            'total' => '<b>{totalCount}</b>'
        ]),
        'pager' => [
            'options' => ['class' => 'pagination', 'style' => 'display:flex; justify-content:flex-end; width:100%; padding:0;'],
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'label' => 'Received/Sent',
                'attribute' => 'received_or_sent',
                'value' => function($message) {
                    if ($message->to === Yii::$app->user->id) {
                        return "Received";
                    }
                    return "Sent";
                },
                'headerOptions' => ['style' => 'min-width: 150px;'],
                'filter' => Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'received_or_sent',
                    'data' => ["to" => "Received", "from" => "Sent"],
                    'theme' => Select2::THEME_BOOTSTRAP,
                    'options' => ['placeholder' => ""],
                    'pluginOptions' => ['allowClear' => true],
                ]),
            ],
            [
                'label' => 'From',
                'attribute' => 'from0.username',
            ],
            [
                'label' => 'To',
                'attribute' => 'to0.username',
            ],
            [
                'attribute' => 'subject',
                'contentOptions' => ['style' => 'max-width: 200px; text-overflow: ellipsis; overflow: hidden;'],
            ],
            [
                'attribute' => 'message_text',
                'format' => 'ntext',
                'contentOptions' => ['style' => 'max-width: 400px; text-overflow: ellipsis; overflow: hidden;'],
            ],
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
