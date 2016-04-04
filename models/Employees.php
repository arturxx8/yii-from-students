<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "employees".
 *
 * @property integer $employee_id
 * @property integer $role_id
 * @property string $login
 * @property string $password
 * @property integer $department_id
 * @property string $photo
 * @property string $fio
 * @property string $position
 * @property string $access_token
 *
 * @property Departments[] $departments
 * @property Departments $department
 * @property Roles $role
 * @property Events[] $events
 * @property Orders[] $orders
 */
class Employees extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    public $authKey;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'employees';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['role_id', 'department_id'], 'integer'],
            [['photo', 'fio', 'position', 'access_token'], 'string'],
            [['login'], 'string', 'max' => 12],
            [['password'], 'string', 'max' => 32],
            [['department_id'], 'exist', 'skipOnError' => true, 'targetClass' => Departments::className(), 'targetAttribute' => ['department_id' => 'department_id']],
            [['role_id'], 'exist', 'skipOnError' => true, 'targetClass' => Roles::className(), 'targetAttribute' => ['role_id' => 'role_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'employee_id' => 'Employee ID',
            'role_id' => 'Role ID',
            'login' => 'Login',
            'password' => 'Password',
            'department_id' => 'Department ID',
            'photo' => 'Photo',
            'fio' => 'Fio',
            'position' => 'Position',
            'access_token' => 'Access Token',
        ];
    }
    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return Employees::find()->where(['employee_id' => $id])->one();
    }
    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return Employees::find()->where(['access_token' => $token])->one();
    }

    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return Employees::find()->where(['login' => $username ])->one();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->employee_id;
    }

    /**
     * @inheritdoc
     */
    public function getDepId()
    {
        return $this->department_id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->access_token;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->access_token === $authKey;
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === md5($password);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartments()
    {
        return $this->hasMany(Departments::className(), ['employee_id' => 'employee_id']);
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
    public function getRole()
    {
        return $this->hasOne(Roles::className(), ['role_id' => 'role_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvents()
    {
        return $this->hasMany(Events::className(), ['employee_id' => 'employee_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Orders::className(), ['employee_id' => 'employee_id']);
    }
}
