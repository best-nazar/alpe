<?php
/**
 * apply dates for product

/* @var $applyDates */

use yii\helpers\Html;
use yii\jui\DatePicker;

?>
<div class="dates_container">
    <div class="row" id="row0">
        <?= Html::label('Початок :')?>
        <?= DatePicker::widget(['name' => '[]begin_date', 'language'=>Yii::$app->language, 'value'=>time(), 'options' => ['class' => 'form-applyDates']]) ?>

        <?= Html::label('Кінець :')?>
        <?= DatePicker::widget(['name' => '[]end_date', 'language'=>Yii::$app->language, 'value'=>time(), 'options' => ['class' => 'form-applyDates']]) ?>

        <?= Html::button('Додати', ['class'=>'addNewDates', 'id'=>'newDate', 'onClick'=>'addNewDatesRow(this)'])?>
    </div>
</div>