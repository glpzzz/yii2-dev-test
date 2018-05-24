<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $model app\models\Client */

$this->title = $model->fullName;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Clients'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="client-view">

    <header class="page-header">

        <nav class="pull-right">
            <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
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
            'name',
            'surname',
            'email:email',
        ],
    ]) ?>

    <div class="row">
        <section class="col-md-6">
            <header class="page-header">
                <h2><?= Yii::t('app', 'Contracts for sell') ?></h2>
            </header>
            <?= $this->render('/contract/_list', [
                'dataProvider' => $sellingDataProvider,
            ]) ?>
        </section>
        <section class="col-md-6">
            <header class="page-header">
                <h2><?= Yii::t('app', 'Contracts to buy') ?></h2>
            </header>
            <?= $this->render('/contract/_list', [
                'dataProvider' => $buyingDataProvider,
            ]) ?>
        </section>
    </div>

</div>
