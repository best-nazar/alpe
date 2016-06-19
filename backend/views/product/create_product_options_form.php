<?php
/**
 * Product Options Form View
 */

use dosamigos\ckeditor\CKEditor;

?>
<div class="product-options-form">
    <?= $form->field($productOptions, 'stars') ?>
    <?= $form->field($productOptions, 'location')->widget(CKEditor::className(), [
        'options' => ['rows' =>6],
        'preset' => 'basic'
    ])?>
    <?= $form->field($productOptions, 'in_hotel')->widget(CKEditor::className(), [
        'options' => ['rows' =>6],
        'preset' => 'basic'
    ]) ?>
    <?= $form->field($productOptions, 'in_room')->widget(CKEditor::className(), [
        'options' => ['rows' =>6],
        'preset' => 'basic'
    ]) ?>
    <?= $form->field($productOptions, 'additional_services')->widget(CKEditor::className(), [
        'options' => ['rows' =>6],
        'preset' => 'basic'
    ]) ?>
    <?= $form->field($productOptions, 'food')->widget(CKEditor::className(), [
        'options' => ['rows' =>6],
        'preset' => 'basic'
    ]) ?>
    <?= $form->field($productOptions, 'beach')->widget(CKEditor::className(), [
        'options' => ['rows' =>6],
        'preset' => 'basic'
    ]) ?>
    <?= $form->field($productOptions, 'note')->widget(CKEditor::className(), [
        'options' => ['rows' =>6],
        'preset' => 'basic'
    ]) ?>
    <?= $form->field($productOptions, 'web') ?>
</div>