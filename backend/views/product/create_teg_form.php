<?php
/**
 * Product Teg Form View
 */

//use yii\helpers\Html;

?>
<div class="product-options-form">
    <?= $form->field($teg, 'meta_description')->textarea(['rows' => 3])?>
    <?= $form->field($teg, 'meta_keywords')->textarea(['rows' => 3]) ?>
</div>