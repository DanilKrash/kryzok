<?php

use app\models\Society;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\modules\admin\SocietyAppSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Кружки');

?>
<div class="society-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Создать кружок'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            'desc:ntext',
            'image',
            'status',

            [
                'attribute'=>'Администрирование',
                'format'=>'html',
                'value'=>function($data) {
                    switch ($data->status) {
                        case 0:
                            return Html::a('Одобрить', Url::toRoute(['society/good', 'id'=>$data->id]))."|".
                                Html::a('Отклонить', Url::toRoute(['society/verybad', 'id'=>$data->id]));
                        case 1:
                            return Html::a('Одобрить', Url::toRoute(['society/good', 'id'=>$data->id]));
                        case 2:
                            return Html::a('Отклонить', Url::toRoute(['society/verybad', 'id'=>$data->id]));
                    }
                }
            ],

            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Society $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
