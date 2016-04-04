<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "statuses".
 *
 * @property integer $status_id
 * @property string $status_name
 *
 * @property Events[] $events
 * @property Orders[] $orders
 */
class Statuses extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'statuses';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status_id'], 'required'],
            [['status_id'], 'integer'],
            [['status_name'], 'string', 'max' => 50],
            [['status_id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'status_id' => 'Status ID',
            'status_name' => 'Status Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvents()
    {
        return $this->hasMany(Events::className(), ['status_id' => 'status_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Orders::className(), ['status' => 'status_id']);
    }
}
