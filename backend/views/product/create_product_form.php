<?php

use yii\helpers\Html;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model common\models\Product */
/* @var $form yii\widgets\ActiveForm */
/* @var $types */
/* @var $countries */
/* @var $currency */
/* @var $actualPeriod */


?>

<div class="product-form">

    <?= $form->field($product, 'country')->dropDownList($countries) ?>

    <?= $form->field($product, 'region1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($product, 'region2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($product, 'type')->dropDownList($types) ?>

    <?= $form->field($product, 'price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($product, 'currency')->dropDownList($currency) ?>

    <?= Html::label('Актуально до :')?>
    <?= DatePicker::widget(['name' => 'actual_date', 'language'=>Yii::$app->language, 'value'=>$actualPeriod, 'options' => ['class' => 'form-control']]) ?>


    <?= $form->field($product, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($product, 'short_desc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($product, 'description')->textarea(['rows' => 6]) ?>

</div>
