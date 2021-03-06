<?php

use yii\helpers\Html;
use yii\jui\Tabs;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $product common\models\Product */
/* @var $productOptions common\models\Productoptions */
/* @var $teg common\models\Teg */
/* @var $options common\models\Options */
/* @var $applyDates common\models\Applydates */

$this->title = 'Новий продукт';
$this->params['breadcrumbs'][] = ['label' => 'Продукти', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$actualPeriod = \common\models\helper::addMonthToNow(Yii::$app->params['actualPeriod']);
?>
<div class="product-create">

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
            'actualPeriod' =>$actualPeriod,
            'sub_type'=>$sub_type,
        ]) ,
    ],
    [
    'label' => 'Додаткова',
    'content' => $this->render('create_product_options_form', [
        'productOptions' => $productOptions,
        'form' => $form,
    ]) ,
    ],
        [
            'label' => 'Налаштування',
            'content' => $this->render('options_form', [
                'options' => $options,
                'form' => $form,
            ]) ,
        ],
        [
            'label' => 'Ціни - Дати',
            'content' => $this->render('_applyDates_form', [
                'form' => $form,
                'actualPeriod'=>$actualPeriod,
                'applyDates' => $applyDates
            ]) ,
        ],
        [
            'label' => 'Службова',
            'content' => $this->render('create_teg_form', [
                'teg' => $teg,
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
        <?= Html::a('Повернутись', Yii::$app->request->referrer, ['class' => 'btn btn-default'])?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
