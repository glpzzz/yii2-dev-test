<?php
use yii\widgets\ListView;
?>

<?= ListView::widget([
    'dataProvider' => $dataProvider,
    'layout' => '{summary}<ul>{items}</ul>{pager}',
    'itemView' => '/contract/_view',
    'itemOptions' => ['tag' => 'li'],
]) ?>
