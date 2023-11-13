<?php

use yii\bootstrap5\Html;

$this->title = 'Личный кабинет';
$this->params['breadcrumbs'][] = $this->title;

?>
<h3 style="margin: 0 0 3vh 0">Личный кабинет <?= Yii::$app->user->identity->username ?></h3>
<div class="container">
    <h4>Ваши заявки:</h4>
    <?php foreach ($user_proposals as $proposal) {?>
        <div class="card" style="margin: 10px 0 10px 0">
            <div class="card-header">
                Заявка №<?= $proposal->id ?>
            </div>
            <div class="card-body">
                <p class="card-text">Запись на кружок <strong><?= $proposal->society->name ?></strong></p>
                <a href="#" class="btn btn-<?= $proposal->getColor() ?> disabled">Статус: <?= $proposal->getStatus() ?></a>
            </div>
        </div>
    <?php } ?>
</div>