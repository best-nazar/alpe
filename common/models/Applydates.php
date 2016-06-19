<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "applydates".
 *
 * @property integer $id
 * @property integer $product_id
 * @property integer $begin_date
 * @property integer $end_date
 * @property string $price
 * @property string $place_type
 *
 * @property Product $product
 */
class Applydates extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'applyDates';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id'], 'required'],
            [['product_id', 'begin_date', 'end_date'], 'integer'],
            [['price'], 'number'],
            [['place_type'], 'string', 'length' => [0,10]],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Product ID',
            'begin_date' => 'Початок',
            'end_date' => 'Кінець',
            'price' => 'Ціна',
            'place_type' => 'Тип розміщення'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }
}
