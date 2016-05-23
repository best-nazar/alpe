<?php
/**
 * apply dates for product

/* @var $applyDates */

use yii\helpers\Html;
use yii\jui\DatePicker;
use unclead\widgets\MultipleInput;

?>
<div class="dates_container">

    <?=MultipleInput::widget([
        'name' =>'applyDates',
        'data' => $applyDates,
        //'limit'             => 6,
        'allowEmptyList'    => true,
        //'enableGuessTitle'  => true,
        'min'               => 1, // should be at least 1 rows
        'addButtonPosition' => MultipleInput::POS_ROW, // show add button in the header
    'columns' => [
        [
            'name'  => 'begin_date',
            'title' => 'Початок',
            'type' => DatePicker::className(),
            'defaultValue' => time(),
            'options' => [
                'class' => 'form-applyDates',
            ]
        ],
        [
            'name'  => 'end_date',
            'title' => 'Кінець',
            'type' => DatePicker::className(),
            'defaultValue' => $actualPeriod,
            'options' => [
                'class' => 'form-applyDates',
            ]
        ],
    ]
]);?>

</div>