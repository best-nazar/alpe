<?php

use yii\helpers\Html;
use yii\jui\Tabs;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $product common\models\Product */
/* @var $productOptions common\models\Productoptions */
/* @var $teg common\models\Teg */
/* @var $options common\models\Options */

$this->title = 'Create Product';
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
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
        <?= Html::submitButton($product->isNewRecord ? 'Create' : 'Update', ['class' => $product->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
