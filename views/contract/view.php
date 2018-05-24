<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Contract */

$this->title = Yii::t('app', 'Contract #{number}', ['number' => $model->number]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Contracts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contract-view">

    <header class="page-header">

        <nav class="pull-right">
            <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->number], ['class' => 'btn btn-primary']) ?>
            <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->number], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ]) ?>
        </nav>

        <h1><?= Html::encode($this->title) ?></h1>
    </header>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'number',
            'date:date',
            'amount:currency',
            [
                'attribute' => 'seller_id',
                'format' => 'html',
                'value' => function ($model) {
                    return Html::a($model->seller->fullName, ['client/view', 'id' => $model->seller_id]);
                }
            ],
            [
                'attribute' => 'buyer_id',
                'format' => 'html',
                'value' => function ($model) {
                    return Html::a($model->buyer->fullName, ['client/view', 'id' => $model->buyer_id]);
                }
            ],
        ],
    ]) ?>

    <?= Yii::$app->formatter->asParagraphs($model->description) ?>

</div>
