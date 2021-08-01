<?php

use common\models\User;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Message */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="message-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="form-row col-md-12">
        <div class="col-md-4">
            <?= $form->field($model, 'to')->widget(Select2::class, [
                'data' => ArrayHelper::map(User::find()->distinct()->asArray()->all(), 'id', 'username'),
                'theme' => Select2::THEME_BOOTSTRAP,
                'options' => [
                    'placeholder' => Yii::t('app', 'Select the recipient...'),
                ],
                'pluginOptions' => [
                    'allowClear' => false
                ],
            ]); ?>
        </div>
        <div class="col-md-8">
            <?= $form->field($model, 'subject')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="form-row col-md-12">
        <div class="col-md-12">
            <?= $form->field($model, 'message_text')->textarea(['rows' => 6]) ?>
        </div>
    </div>


    <div class="form-row col-md-12">
        <div class="col-md-12 form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
