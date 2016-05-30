<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\Tabs;

$this->title = 'Контакти';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-sm-8">
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>
    <?=Tabs::widget([
        'items' => [
            [
                'label' => 'Контакти',
                'content' => $this->render('_contact'),
                'active' => true
            ],
            [
                'label' => 'Зворотній зв`язок',
                'content' => $this->render('_feedback', [
                    'model' => $model
                ]),
            ],
        ]
    ])?>
</div>
</div>
<div class="col-sm-2">
</div>