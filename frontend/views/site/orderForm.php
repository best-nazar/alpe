<?php
/**
 * OrderFrom
 *
 * @var $model common\models\Orders
 * @var $product common\models\Product
 */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use common\widgets\Stars;

$country = \common\models\helper::getCountry($product->country);
$type = $product->type0->name;

$this->title = Yii::$app->params['orgName'].' - Замовлення - '.$product->name;
$this->params['breadcrumbs'][] = ['label' => $country->name, 'url' => ['site/by-country', 'countryId' => $product->country]];
$this->params['breadcrumbs'][] = ['label' => $type, 'url' => ['site/show-product', 'id' => $product->id]];
$this->params['breadcrumbs'][] = $product->name;
?>
<div class="col-sm-10">
<div class="row">
    <div class="col-lg-10">
        <h1>Форма попереднього замовлення</h1>
        <div class="alpe_fuul_blog_detail_padding">
            <h2><a href="<?=\yii\helpers\Url::to(['site/show-product', 'id'=>$model->id])?>">
                    <?=$product->name?>
                </a>
                <div class="starsWidget">
                    <?=Stars::widget([
                        'product'=>$product
                    ]);?>
                </div>
            </h2>

            <p><?=$product->short_desc?></p>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-10">
        <?php $form = ActiveForm::begin(['id' => 'order-form']); ?>

        <?= $form->field($model, 'customer_name')->textInput(['autofocus' => true]) ?>
        <?= $form->field($model, 'customer_phone') ?>
        <?= $form->field($model, 'customer_email') ?>

        <?= $form->field($model, 'message')->textArea(['rows' => 6]) ?>


        <div class="form-group">
            <?= Html::submitButton('Замовити', ['class' => 'btn btn-primary', 'name' => 'order-button']) ?>
            <?= Html::a('Продовжити вибір', ['site/by-country', 'countryId' => $product->country], ['class'=>'btn btn-default']);?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
</div><!-- col -->