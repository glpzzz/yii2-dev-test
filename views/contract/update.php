<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Contract */

$this->title = Yii::t('app', 'Update Contract: {nameAttribute}', [
    'nameAttribute' => '' . $model->number,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Contracts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Contract #{number}', ['number' => $model->number]), 'url' => ['view', 'id' => $model->number]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="contract-update">

    <header class="page-header">
        <h1><?= Html::encode($this->title) ?></h1>
    </header>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
