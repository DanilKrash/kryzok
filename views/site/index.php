<?php

/** @var yii\web\View $this */

use yii\bootstrap5\Html;
use yii\bootstrap5\LinkPager;

$this->title = 'Кружки';
?>
<h3>Список всех доступных кружков</h3>

<div style="display: flex; align-items: flex-start; margin-top: 100px">
    <div style="border: 1px solid #dedede; display: flex; width: 250px; border-radius: 10px; justify-content: center">
        <ul class="nav flex-column">
            <li class="nav-item">
                <h6 aria-current="page">Категория возрастов</h6>
            </li>
            <?php if (count($age) != 2) { ?>
                <?php foreach ($age as $item) { ?>
                        <li class="nav-item">
                            <p class="m-1"><a href="<?php echo \yii\helpers\Url::toRoute(['site/index', 'id' => $item['id']]); ?>"
                                               class="text-decoration-none text-primary"><?php echo $item['age'] ?></a></p>
                        </li>
                <?php } ?>
            <?php } ?>
        </ul>
    </div>
    <div style="margin-left: 100px; display: flex;">
        <?php foreach ($societies as $society) { ?>
            <?php if ($society->status == 2) { ?>
                <div class="card m-4" style="width: 18rem; height: 450px; margin: 0 50px 0 50px">
                    <img class="card-img-top" src="images/<?php echo $society['image'] ?>" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $society['name'] ?></h5>
                        <p class="card-text"><?php echo $society->desc = \yii\helpers\StringHelper::truncate($society['desc'],100,'...'); ?></p>
                        <a href="<?php echo \yii\helpers\Url::toRoute(['site/societyinfo', 'id' => $society['id']]) ?>"
                           class="btn btn-primary">Подробнее...</a>
                    </div>
                </div>
            <?php } else {
                break; ?>
            <?php }
        } ?>
    </div>
</div>

<div class="h-100 d-flex align-items-center justify-content-center mt-5">
    <?php echo LinkPager::widget(['pagination' => $pages,]);?>
</div>