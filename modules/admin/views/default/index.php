<div class="admin-default-index">
    <h4>Добро пожаловать <?php echo Yii::$app->user->identity->username?></h4>
    <a href="<?php echo \yii\helpers\Url::toRoute(['proposal/index'])?>" class="btn btn-outline-success">Заявки</a>
    <a href="<?php echo \yii\helpers\Url::toRoute(['society/index'])?>" class="btn btn-outline-success">Кружки</a>
    <a href="<?php echo \yii\helpers\Url::toRoute(['timelist/index'])?>" class="btn btn-outline-success">Расписание</a>
</div>
