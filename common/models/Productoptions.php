<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "productoptions".
 *
 * @property integer $id
 * @property integer $product
 * @property string $location
 * @property string $stars
 * @property string $in_hotel
 * @property string $in_room
 * @property string $additional_services
 * @property string $food
 * @property string $beach
 * @property string $note
 * @property string $web
 *
 * @property Product $product0
 */
class Productoptions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'productoptions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product'], 'integer'],
            [['location', 'in_hotel', 'in_room', 'additional_services', 'food', 'beach', 'note', 'web'], 'string'],
            [['stars'], 'required'],
            [['stars'], 'string', 'max' => 3],
            [['product'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product' => 'Product',
            'location' => 'Місцезнаходження',
            'stars' => 'К-сть зірок',
            'in_hotel' => 'В готелі',
            'in_room' => 'В номері',
            'additional_services' => 'Додаткові послуги',
            'food' => 'Харчування',
            'beach' => 'Пляж',
            'note' => 'Примітка',
            'web' => 'Web-адреса',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct0()
    {
        return $this->hasOne(Product::className(), ['id' => 'product']);
    }

    /**
     * @inheritdoc
     * @return ProductoptionsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProductoptionsQuery(get_called_class());
    }
}
