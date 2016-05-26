<?php

use yii\helpers\Html;
use yii\jui\Tabs;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $product common\models\Product */

$this->title = 'Редагувати : ' . $product->name;
$this->params['breadcrumbs'][] = ['label' => 'Продукти', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $product->name, 'url' => ['view', 'id' => $product->id]];
$this->params['breadcrumbs'][] = 'Редагування';

$actualPeriod = \common\models\helper::addMonthToNow(Yii::$app->params['actualPeriod']);
?>
<div class="product-update">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php $form = ActiveForm::begin(); ?>
        <?php echo Tabs::widget([
            'items' => [
                [
                    'label' => 'Основна інформація',
                    'content' => $this->render('create_product_form', [
                        'product' => $product,
                        'countries' => $countries,
                        'types' => $types,
                        'currency' => $currency,
                        'form' => $form,
                        'actualPeriod' => $actualPeriod
                    ]) ,
                ],
                [
                    'label' => 'Додаткова',
                    'content' => $this->render('create_product_options_form', [
                        'productOptions' => $product->productoptions[0],
                        'form' => $form,
                    ]) ,
                ],
                [
                    'label' => 'Налаштування',
                    'content' => $this->render('options_form', [
                        'options' => $product->options0,
                        'form' => $form,
                    ]) ,
                ],
                [
                    'label' => 'Дати',
                    'content' => $this->render('_applyDates_form', [
                        'applyDates' => $product->applydates,
                        'form' => $form,
                        'actualPeriod' => $actualPeriod
                    ]) ,
                ],
                [
                    'label' => 'Службова',
                    'content' => $this->render('create_teg_form', [
                        'teg' => $product->teg0,
                        'form' => $form,
                    ]) ,
                ],

            ],
            'options' => ['tag' => 'div'],
            'itemOptions' => ['tag' => 'div'],
            'headerOptions' => ['class' => 'my-class'],
            'clientOptions' => ['collapsible' => false],
        ]); ?>
        <p>&nbsp;</p>
        <div class="form-group">
            <?= Html::submitButton($product->isNewRecord ? 'Створити' : 'Змінити', ['class' => $product->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            <?= Html::a('Повернутись', Yii::$app->request->referrer, ['class'=> 'btn btn-default'])?>
        </div>

        <?php ActiveForm::end(); ?>
</div>
