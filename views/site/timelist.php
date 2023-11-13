<?php

use yii\bootstrap5\Html;

$this->title = 'Расписание всех кружков';
$this->params['breadcrumbs'][] = $this->title;

?>
<h3><?= Html::encode($this->title) ?></h3>

<table style="margin-top: 100px" class="table">
  <thead>
    <tr>
      <th scope="col">Кружок</th>
      <th scope="col">Будни</th>
      <th scope="col">Выходные</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($timelists as $time): ?>
    <tr>
          <td><?php echo $time->society->name ?></td>
          <td><?php echo $time['weekday'] ?></td>
          <td><?php echo $time['weekends'] ?></td>
      <?php endforeach; ?>
    </tr>
  </tbody>
</table>