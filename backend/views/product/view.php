<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

use yii\jui\Tabs;
use yii\data\ArrayDataProvider;

/* @var $this yii\web\View */
/* @var $model common\models\Product */
/* @var $modelImages common\models\Images */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Продукти', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редагувати', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Знищити', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Повернутись', ['index'], ['class'=> 'btn btn-default'])?>
        <?= Html::a('Створити новий', ['create'], ['class'=>'btn btn-success']);?>
    </p>
    <?php echo Tabs::widget([
        'items' => [
            [
                'label' => 'Основна інформація',
                'content' => DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'id',
                        [                      // the owner name of the model
                            'label' => 'Країна',
                            'value' => $model->country0->name,
                        ],
                        'region1',
                        'region2',
                        [
                          'label' => 'Вид',
                            'value' => $model->getSubType(),
                        ],
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
                        'description:html',
                        //'status',
                        //'main_image',
                        'created_at:date',
                        'updated_at:date',
                    ],
                ]),

            ],
            [
                'label' => 'Додаткова інформація',
                'content' => DetailView::widget([
                    'model' => $model->productoptions[0],
                    'attributes' => [
                        'location:html',
                        'stars:html',
                        'in_hotel:html',
                        'in_room:html',
                        'additional_services:html',
                        'food:html',
                        'beach:html',
                        'note:html',
                        'web',
                    ],
                ]),

            ],
            [
                'label' => 'Налаштування',
                'content' => DetailView::widget([
                   'model'=>$model->options0,
                    'attributes' => [
                        [
                            'attribute' => 'show_in_teaser',
                            'value' => $model->options0->show_in_teaser == 1 ? 'Так' : 'Ні'
                        ],
                        [
                            'attribute' => 'show_in_dash',
                            'value' => $model->options0->show_in_dash == 1 ? 'Так' : 'Ні'
                        ],
                        [
                            'attribute' => 'show_in_homepage',
                            'value' => $model->options0->show_in_homepage == 1 ? 'Так' : 'Ні'
                        ],
                        [
                            'attribute' => 'show_in_other',
                            'value' => $model->options0->show_in_other == 1 ? 'Так' : 'Ні'
                        ],
                    ]
                ]),
            ],
            [
            'label' => 'Ціни-Дати',
            'content' => GridView::widget([
            'dataProvider' => new ArrayDataProvider([
            'allModels' => $model->applydates,
            ]),
            'columns' => [
                'begin_date:date',
                'end_date:date',
                'place_type',
                'price',
            ],

            ]),
            ],
            [
                'label' => 'Службова',
                'content' => DetailView::widget([
                    'model'=>$model->teg0,
                    'attributes' => [
                        'meta_title',
                        'meta_description',
                        'meta_keywords',
                    ]
                ]),
            ],
            [
                'label' => 'Фото',
                'content' => $this->render('image_gallery', [
                    'model' => $model,
                    'modelImages' =>$modelImages
                ]),
            ],

        ],
        //'options' => ['tag' => 'div'],
        //'itemOptions' => ['tag' => 'div'],
        'headerOptions' => ['class' => 'tab-class'],
        'clientOptions' => ['collapsible' => true],
    ]); ?>

</div>