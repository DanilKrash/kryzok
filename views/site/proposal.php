<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Proposal $model */
/** @var ActiveForm $form */

$this->title = 'Запись на кружок';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="site-proposal">
    <h3><?= Html::encode($this->title) ?></h3>


    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'whole_name')->textInput(['autofocus' => true]) ?>
        <?= $form->field($model, 'telephone')->widget(\yii\widgets\MaskedInput::className(), [
            'mask' => '+7 (999)-999-99-99']) ?>
        <?= $form->field($model, 'age_id')->textInput()->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Age::find()->all(), 'id', 'age')) ?>
        <?= $form->field($model, 'society_id')->textInput()->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Society::find()->all(), 'id', 'name')) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Оставить заявку'), ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
