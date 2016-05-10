<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property integer $id
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $customer_name
 * @property string $customer_phone
 * @property string $customer_email
 * @property string $message
 * @property integer $selected_product
 * @property integer $order_status
 */
class Orders extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at', 'customer_name', 'customer_phone', 'selected_product'], 'required'],
            [['created_at', 'updated_at', 'selected_product', 'order_status'], 'integer'],
            [['customer_name', 'message'], 'string', 'max' => 255],
            [['customer_phone'], 'string', 'max' => 15],
            [['customer_email'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'customer_name' => 'Ім`я замовника',
            'customer_phone' => 'Телефон',
            'customer_email' => 'e-mail',
            'message' => 'Повідомлення',
            'selected_product' => 'Selected Product',
            'order_status' => 'Статус',
        ];
    }

    /**
     * @inheritdoc
     * @return OrdersQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OrdersQuery(get_called_class());
    }
}
