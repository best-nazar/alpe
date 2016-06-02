<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

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
            [['customer_name', 'customer_phone', 'selected_product'], 'required'],
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

    /**
     * Sends an email to the specified email address using the information collected by this model.
     *
     * @param string $email the target email address
     * @return boolean whether the email was sent
     */
    public function sendEmail($email)
    {
        $prodName='';
        $prodLocation = '';

        $product = Product::findOne($this->selected_product);
        if ($product){
            $prodName = $product->name;
            $prodLocation = $product->country0->name;
            $prodId = $product->id;
        }

            $from = Yii::$app->params['supportEmail'];


        $body = '<p>';
        $body .= '<i>Ім`я : </i>';
        $body .= '<b>'.$this->customer_name.'</b>';
        $body .= '</p>';

        $body .= '<p>';
        $body .= '<i>Тел : </i>';
        $body .= '<b>'.$this->customer_phone.'</b>';
        $body .= '</p>';

        $body .= '<p>';
        $body .= '<i>email : </i>';
        $body .= '<b>'.$this->customer_email.'</b>';
        $body .= '</p>';

        $body .= '<p>';
        $body .= '<i>Обраний продукт : </i>';
        $body .= '<h4> <a href="http://www.alpeadriatour.com/product/'.$prodId.'">'.$prodName.'</a></h4>';
        $body .= '<b>'.$prodLocation.'</b>';
        $body .= '</p>';

        $body .= '<p>';
        $body .= '<i>Текст повідомлення : </i>';
        $body .= '<b>'.$this->message.'</b>';
        $body .= '</p>';

        return Yii::$app->mailer->compose()
            ->setTo($email)
            ->setFrom($from)
            ->setSubject('Замовлення з сайту !')
            ->setHtmlBody($body)
            ->send();
    }
}
