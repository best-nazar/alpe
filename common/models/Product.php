<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "product".
 *
 * @property integer $id
 * @property integer $country
 * @property string $region1
 * @property string $region2
 * @property integer $type
 * @property string $price
 * @property integer $currency
 * @property integer $actual_date
 * @property integer $options
 * @property string $name
 * @property string $short_desc
 * @property string $description
 * @property integer $status
 * @property integer $teg
 * @property string $main_image
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Applydates[] $applydates
 * @property Country $country0
 * @property Currency $currency0
 * @property Options $options0
 * @property Teg $teg0
 * @property Types $type0
 * @property Productoptions[] $productoptions
 */
class Product extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['country', 'type', 'currency', 'actual_date', 'options', 'name', 'teg'], 'required'],
            [['country', 'type', 'currency', 'actual_date', 'options', 'status', 'teg', 'created_at', 'updated_at'], 'integer'],
            [['price'], 'number'],
            [['description'], 'string'],
            [['region1', 'region2'], 'string', 'max' => 128],
            [['name', 'short_desc'], 'string', 'max' => 255],
            [['main_image'], 'string', 'max' => 50],
            [['country'], 'exist', 'skipOnError' => true, 'targetClass' => Country::className(), 'targetAttribute' => ['country' => 'id']],
            [['currency'], 'exist', 'skipOnError' => true, 'targetClass' => Currency::className(), 'targetAttribute' => ['currency' => 'id']],
            [['options'], 'exist', 'skipOnError' => true, 'targetClass' => Options::className(), 'targetAttribute' => ['options' => 'id']],
            [['teg'], 'exist', 'skipOnError' => true, 'targetClass' => Teg::className(), 'targetAttribute' => ['teg' => 'id']],
            [['type'], 'exist', 'skipOnError' => true, 'targetClass' => Types::className(), 'targetAttribute' => ['type' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'country' => 'Країна',
            'region1' => 'Регіон 1*',
            'region2' => 'Регіон 2*',
            'type' => 'Тип',
            'price' => 'Ціна',
            'currency' => 'Валюта',
            'actual_date' => 'Актуальний до:',
            'options' => 'Options',
            'name' => 'Назва',
            'short_desc' => 'Короткий опис',
            'description' => 'Повний опис',
            'status' => 'Службове',
            'teg' => 'Teg',
            'main_image' => 'Main Image',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApplydates()
    {
        return $this->hasMany(Applydates::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry0()
    {
        return $this->hasOne(Country::className(), ['id' => 'country']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCurrency0()
    {
        return $this->hasOne(Currency::className(), ['id' => 'currency']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOptions0()
    {
        return $this->hasOne(Options::className(), ['id' => 'options']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTeg0()
    {
        return $this->hasOne(Teg::className(), ['id' => 'teg']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType0()
    {
        return $this->hasOne(Types::className(), ['id' => 'type']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductoptions()
    {
        return $this->hasMany(Productoptions::className(), ['product' => 'id']);
    }

    /**
     * @inheritdoc
     * @return ProductQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProductQuery(get_called_class());
    }

    /**
     * @inheritdoc
     * @return array
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'created_at',
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'updated_at',
                ],
            ],
        ];
    }
}
