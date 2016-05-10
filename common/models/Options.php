<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "options".
 *
 * @property integer $id
 * @property integer $show_in_teaser
 * @property integer $show_in_dash
 * @property integer $show_in_homepage
 * @property integer $show_in_other
 *
 * @property Product[] $products
 */
class Options extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'options';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['show_in_teaser', 'show_in_dash', 'show_in_homepage', 'show_in_other'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'show_in_teaser' => 'Показувати в Тізері',
            'show_in_dash' => 'Показувати на панелі',
            'show_in_homepage' => 'Виводити на головній сторінці',
            'show_in_other' => 'Показувати у блоці',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['options' => 'id']);
    }
}
