<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Timelist $model */

$this->title = Yii::t('app', 'Create Timelist');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Timelists'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="timelist-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
