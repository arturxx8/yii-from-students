<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "items".
 *
 * @property integer $item_id
 * @property integer $category_id
 * @property integer $department_id
 * @property string $unit
 * @property string $item_name
 *
 * @property Categories $category
 * @property Departments $department
 * @property OrderedItems[] $orderedItems
 */
class Items extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'items';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'department_id'], 'integer'],
            [['unit'], 'string', 'max' => 12],
            [['item_name'], 'string', 'max' => 50],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categories::className(), 'targetAttribute' => ['category_id' => 'category_id']],
            [['department_id'], 'exist', 'skipOnError' => true, 'targetClass' => Departments::className(), 'targetAttribute' => ['department_id' => 'department_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'item_id' => 'Item ID',
            'category_id' => 'Category ID',
            'department_id' => 'Department ID',
            'unit' => 'Unit',
            'item_name' => 'Item Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Categories::className(), ['category_id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartment()
    {
        return $this->hasOne(Departments::className(), ['department_id' => 'department_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderedItems()
    {
        return $this->hasMany(OrderedItems::className(), ['item_id' => 'item_id']);
    }
}
