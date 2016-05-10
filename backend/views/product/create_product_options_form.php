<?php
/**
 * Product Options Form View
 */

//use yii\helpers\Html;

?>
<div class="product-options-form">
    <?= $form->field($productOptions, 'stars') ?>
    <?= $form->field($productOptions, 'location')->textarea(['rows' => 6])?>
    <?= $form->field($productOptions, 'in_hotel')->textarea(['rows' => 6]) ?>
    <?= $form->field($productOptions, 'in_room')->textarea(['rows' => 6]) ?>
    <?= $form->field($productOptions, 'additional_services')->textarea(['rows' => 6]) ?>
    <?= $form->field($productOptions, 'food')->textarea(['rows' => 6]) ?>
    <?= $form->field($productOptions, 'beach')->textarea(['rows' => 6]) ?>
    <?= $form->field($productOptions, 'note')->textarea(['rows' => 6]) ?>
    <?= $form->field($productOptions, 'web') ?>
</div>