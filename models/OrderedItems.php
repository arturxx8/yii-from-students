<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ordered_items".
 *
 * @property integer $order_id
 * @property integer $item_id
 * @property integer $amount
 * @property integer $id
 *
 * @property Items $item
 * @property Orders $order
 */
class OrderedItems extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ordered_items';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id'], 'required'],
            [['order_id', 'item_id', 'amount'], 'integer'],
            [['item_id'], 'exist', 'skipOnError' => true, 'targetClass' => Items::className(), 'targetAttribute' => ['item_id' => 'item_id']],
            [['order_id'], 'exist', 'skipOnError' => true, 'targetClass' => Orders::className(), 'targetAttribute' => ['order_id' => 'order_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'order_id' => 'Order ID',
            'item_id' => 'Item ID',
            'amount' => 'Amount',
            'id' => 'ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(Items::className(), ['item_id' => 'item_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Orders::className(), ['order_id' => 'order_id']);
    }

    public static function findById($id){
        return OrderedItems::find()->where(['id'=>$id])->one();
    }
}
