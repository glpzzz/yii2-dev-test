<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ClientSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Clients');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="client-index">

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
            'name',
            'surname',
            'email:email',
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
