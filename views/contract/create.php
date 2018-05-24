<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Contract */

$this->title = Yii::t('app', 'Create Contract');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Contracts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contract-create">

    <header class="page-header">
        <h1><?= Html::encode($this->title) ?></h1>
    </header>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
