<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'layout' => "{items}\n{pager}\n<span style='display:flex; justify-content:flex-end'>{summary}</span>",
        'summary' => Yii::t("app", 'Showing users {range} of {total}.', [
            'range' => '<b>{begin}-{end}</b>',
            'total' => '<b>{totalCount}</b>'
        ]),
        'pager' => [
            'options' => ['class' => 'pagination', 'style' => 'display:flex; justify-content:flex-end; width:100%; padding:0;'],
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'username',
            'email:email',
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
