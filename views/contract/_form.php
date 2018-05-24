<?php

use app\models\Client;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Contract */
/* @var $form yii\widgets\ActiveForm */

$people = ArrayHelper::map(Client::find()->all(), 'id', 'fullName');

?>

<div class="contract-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'number')->textInput() ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'date')->widget(DatePicker::class, [
                'dateFormat' => 'medium',
                'options' => [
                    'class' => 'form-control',
                ]
            ]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'amount')->textInput() ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'seller_id')->dropDownList($people) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'buyer_id')->dropDownList($people) ?>
        </div>
    </div>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
