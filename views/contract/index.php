<?php

use app\models\Client;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ContractSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Contracts');
$this->params['breadcrumbs'][] = $this->title;
$people = ArrayHelper::map(Client::find()->all(), 'id', 'fullName');
?>
<div class="contract-index">

    <header class="page-header">
        <h1><?= Html::encode($this->title) ?></h1>
    </header>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'number',
            'amount:currency',
            [
                'attribute' => 'seller_id',
                'filter' => $people,
                'format' => 'html',
                'value' => function ($model) {
                    return Html::a($model->seller->fullName, ['client/view', 'id' => $model->seller_id]);
                }
            ],
            [
                'attribute' => 'buyer_id',
                'filter' => $people,
                'format' => 'html',
                'value' => function ($model) {
                    return Html::a($model->buyer->fullName, ['client/view', 'id' => $model->buyer_id]);
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => Html::a(Yii::t('app', 'Add'), ['create'], ['class' => 'btn btn-success btn-block']),
                'options' => ['width' => '100px'],
                'contentOptions' => ['style' => 'text-align: center'],
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
