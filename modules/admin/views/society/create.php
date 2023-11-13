<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Society $model */

$this->title = Yii::t('app', 'Create Society');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Societies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="society-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
