<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "events".
 *
 * @property integer $event_id
 * @property integer $order_id
 * @property integer $status_id
 * @property integer $employee_id
 * @property string $comment
 * @property string $date
 *
 * @property Employees $employee
 * @property Orders $order
 * @property Statuses $status
 */
class Events extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'events';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'status_id', 'employee_id'], 'integer'],
            [['comment'], 'string'],
            [['date'], 'safe'],
            [['employee_id'], 'exist', 'skipOnError' => true, 'targetClass' => Employees::className(), 'targetAttribute' => ['employee_id' => 'employee_id']],
            [['order_id'], 'exist', 'skipOnError' => true, 'targetClass' => Orders::className(), 'targetAttribute' => ['order_id' => 'order_id']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => Statuses::className(), 'targetAttribute' => ['status_id' => 'status_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'event_id' => 'Event ID',
            'order_id' => 'Order ID',
            'status_id' => 'Status ID',
            'employee_id' => 'Employee ID',
            'comment' => 'Comment',
            'date' => 'Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmployee()
    {
        return $this->hasOne(Employees::className(), ['employee_id' => 'employee_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Orders::className(), ['order_id' => 'order_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(Statuses::className(), ['status_id' => 'status_id']);
    }
}
