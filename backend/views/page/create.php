<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Page */

$this->title = 'Створити сторінку';
$this->params['breadcrumbs'][] = ['label' => 'Сторінки', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
