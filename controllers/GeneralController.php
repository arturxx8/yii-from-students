<?php

namespace app\controllers;
use app\models\Items;
use app\models\OrderedItems;
use app\models\OrderForm;
use app\models\User;
use Yii;
use app\models\Orders;
use yii\db\Query;
use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;
use app\models\Employees;
use app\models\Departments;
use app\models\Roles;
use app\models\Events;

class GeneralController extends \yii\web\Controller
{
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect('http://deriabin.xyz/');
        }
        else
        {
            $employees=Employees::findOne(Yii::$app->user->id);
            $employee = [
                'role'=>Roles::findOne($employees->role_id)->role_name,
                'login'=>$employees->login,
                'fio'=>$employees->fio,
                'department'=>Departments::findOne($employees->department_id)->department_name,
                'position'=>$employees->position
            ];
            $employees->role_id=Roles::findOne($employees->role_id)->role_name;
            $employees->department_id=Departments::findOne($employees->department_id)->department_name;
            return $this->render('profile',
                [
                    'employees' => $employees
                ]);
        }
    }

    


}