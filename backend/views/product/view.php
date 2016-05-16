<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use dosamigos\fileupload\FileUploadUI;

/* @var $this yii\web\View */
/* @var $model common\models\Product */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [                      // the owner name of the model
                'label' => 'Країна',
                'value' => $model->country0->name,
            ],
            'region1',
            'region2',
            [                      // the owner name of the model
                'label' => 'Тип',
                'value' => $model->type0->name,
            ],
            'price',
            [                      // the owner name of the model
                'label' => 'Валюта',
                'value' => $model->currency0->label,
            ],
            'actual_date:date',
            'name',
            'short_desc',
            'description:ntext',
            'status',
            'main_image',
            'created_at',
            'updated_at',
        ],
    ]) ?>
        <?= DetailView::widget([
        'model' => $model->options0,
            'attributes' => [
                'id',
            ],
    ]) ?>

    <?= FileUploadUI::widget([
        //'model' => $model,
        'name'=> 'files',
        'attribute' => 'main_image',
        'url' => ['product/image-upload', 'id' => $model->id],
        'gallery' => false,
        'fieldOptions' => [
            'accept' => 'image/*'
        ],
        'clientOptions' => [
            'maxFileSize' => 2000000
        ],
        // ...
        'clientEvents' => [
            'fileuploaddone' => 'function(e, data) {
                                    console.log(e);
                                    console.log(data);
                                }',
            'fileuploadfail' => 'function(e, data) {
                                    console.log(e);
                                    console.log(data);
                                }',
        ],
    ]);
    ?>
</div>