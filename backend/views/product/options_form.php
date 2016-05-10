<?php
/**
 * Options Form View
 */
?>
<div class="options-form">
    <?= $form->field($options, 'show_in_teaser')->checkbox() ?>
    <?= $form->field($options, 'show_in_dash')->checkbox()?>
    <?= $form->field($options, 'show_in_homepage')->checkbox() ?>
</div>