<?php
use yii\helpers\Html;
?>

<?= Html::a(Yii::t('app', 'Contract #{number}', [
    'number' => $model->number
]), ['contract/view', 'id' => $model->number]) ?>
