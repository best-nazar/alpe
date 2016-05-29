<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Country */

$this->title = 'Нова країна';
$this->params['breadcrumbs'][] = ['label' => 'Країни', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="country-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
