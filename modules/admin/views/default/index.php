<div style="display: flex; width: 500px; height: auto; background: #212529; flex-direction: column; border-radius: 10px">
    <h4 style="color: white; margin: 10px">Добро пожаловать <?php echo Yii::$app->user->identity->username ?></h4>
    <h5 style="color: white; margin: 10px 0 10px 20px">Выберите пункт для изменения</h5>
    <div style="display: flex; align-items: center; flex-direction: column">
        <a href="<?php echo \yii\helpers\Url::toRoute(['proposal/index']) ?>" style="margin: 30px 0 30px 0; opacity: 0.7; width: 300px" class="btn btn-outline-info">Заявки</a>
        <a href="<?php echo \yii\helpers\Url::toRoute(['society/index']) ?>" style="opacity: 0.7; width: 300px" class="btn btn-outline-info">Кружки</a>
        <a href="<?php echo \yii\helpers\Url::toRoute(['timelist/index']) ?>" style="margin: 30px 0 30px 0; opacity: 0.7; width: 300px" class="btn btn-outline-info">Расписание</a>
    </div>
</div>
