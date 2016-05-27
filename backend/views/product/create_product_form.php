<?php

use yii\helpers\Html;
use yii\jui\DatePicker;
use dosamigos\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model common\models\Product */
/* @var $form yii\widgets\ActiveForm */
/* @var $types */
/* @var $countries */
/* @var $currency */
/* @var $actualPeriod */


?>

<div class="table-responsive">
    <table class="table">
        <tbody>
        <tr>
            <td><?= $form->field($product, 'country')->dropDownList($countries) ?></td>
            <td><?= $form->field($product, 'region1')->textInput(['maxlength' => true]) ?></td>
            <td><?= $form->field($product, 'region2')->textInput(['maxlength' => true]) ?></td>
        </tr>
        <tr>
            <td><?= $form->field($product, 'type')->dropDownList($types) ?></td>
            <td><?= $form->field($product, 'price')->textInput(['maxlength' => true]) ?></td>
            <td><?= $form->field($product, 'currency')->dropDownList($currency) ?></td>
        </tr>
        <tr>
            <td><?= Html::label('Актуально до :')?>
                <?= DatePicker::widget(['name' => 'actual_date', 'language'=>Yii::$app->language, 'value'=>$actualPeriod, 'options' => ['class' => 'form-control']]) ?></td>
            <td> </td>
            <td> </td>
        </tr>
        </tbody>
    </table>



    <?= $form->field($product, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($product, 'short_desc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($product, 'description')->widget(CKEditor::className(), [
        'options' => ['rows' => 8],
        'preset' => 'basic'
    ]) ?>

</div>
