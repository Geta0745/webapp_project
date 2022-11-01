<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order_cart".
 *
 * @property int $id
 * @property int $product_id
 * @property int $user_id
 * @property int $amount
 * @property string $order_date
 */
class OrderCart extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order_cart';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'user_id', 'amount', 'order_date'], 'required'],
            [['product_id', 'user_id', 'amount'], 'integer'],
            [['order_date'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Product ID',
            'user_id' => 'User ID',
            'amount' => 'Amount',
            'order_date' => 'Order Date',
        ];
    }
}
