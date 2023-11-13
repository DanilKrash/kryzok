<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Comment $model */
/** @var ActiveForm $form */

$this->title = 'Информация о кружке';
$this->params['breadcrumbs'][] = $this->title;

?>
<h3><?php echo $society['name'] ?></h3>
<div style="display: flex; margin-top: 50px">
    <div class="container">
        <div style="width: 100%; height: auto">
            <img src="images/<?php echo $society["image"] ?>" style="width: 500px; box-shadow: 0 0 8px 8px white inset;" alt="...">
        </div>
    </div>
    <div class="container">
    
        <div style="width: 80%;">
            <h3>Описание:</h3>
            <p><?= $society['desc'] ?></p>
        </div>
    
        <h3 style="margin-top: 50px">Расписание: </h3>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Будни</th>
                <th scope="col">Выходные</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <?php foreach ($timelists as $time): ?>
                    <td><?php echo $time['weekday'] ?></td>
                    <td><?php echo $time['weekends'] ?></td>
                <?php endforeach; ?>
            </tr>
            </tbody>
        </table>
    </div>
</div>    

<?php if (!Yii::$app->user->isGuest): ?>
    <div style="margin-top: 100px; width: 500px">

        <div class="site-comment">
            <h4>Оставте свой комментарий</h4>


            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'text')->textarea(['autofocus' => true]) ?>

            <div class="form-group">
                <?= Html::submitButton(Yii::t('app', 'Оставить'), ['class' => 'btn btn-primary']) ?>
            </div>
            <?php ActiveForm::end(); ?>

        </div>
    </div>
<?php endif; ?>
    <div style="margin-top: 50px" class="container d-flex justify-content-start align-items-start flex-wrap">
        <h4>Комментарии</h4>
        <?php foreach ($comments as $comment) { ?>
            <div style="width: 100%; min-height: 10vh; padding: 1%; margin: 0.4%; border-radius: 3px">
                <h5><?= $comment->user->username ?> </h5>
                <p><?= $comment->text ?></p>
            </div>
        <?php } ?>
    </div>

