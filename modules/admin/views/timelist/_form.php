<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Timelist $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="timelist-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'weekday')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'weekends')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'society_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
