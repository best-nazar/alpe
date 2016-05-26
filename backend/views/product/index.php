<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\grid\DataColumn;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Продукти';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Створити продукт', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'id',
                'value' => 'id',
                'contentOptions'=>['style'=>'width: 50px;']
            ],
            [
                'attribute' => 'country',
                'value' => 'country0.name'
            ],
            'name',
            'region1',
            'region2',
            [
                'attribute' => 'type',
                'value' => 'type0.name'
            ],
            [
                'attribute' => 'price',
                'value' => 'price',
                'contentOptions'=>['style'=>'width: 50px;'],
                'format'=>['decimal',2]
            ],
            [
                'attribute' => 'currency',
                'value' => 'currency0.label',
                'contentOptions'=>['style'=>'width: 50px;']
            ],
            [
                'attribute' => 'actual_date',
                'value' => 'actual_date',
                'format' => 'date',
                'contentOptions'=>['style'=>'width: 135px;']
            ],
            // 'options',

            // 'short_desc',
            // 'description:ntext',
            // 'status',
            // 'teg',
            // 'main_image',
            [
                'attribute' => 'created_at',
                'value' => 'created_at',
                'format' => 'date',
                'label' => 'Створено',
                'contentOptions'=>['style'=>'width: 100px;']
            ],

            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
