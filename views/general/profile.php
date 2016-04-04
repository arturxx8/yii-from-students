<?php
/**
 * Created by PhpStorm.
 * User: slav-yrich
 * Date: 01.04.16
 * Time: 18:01
 */
use yii\bootstrap\ActiveForm;

$this->title = 'Профиль';
echo "Здравствуйте, ";
if ($employees->fio!="null")
{
    echo $employees->fio;
}
else
{
    echo $employees->login;
}
echo "!<br /><br />";
echo "Ваш логин: "; echo $employees->login;
echo "<br />";
echo "Ваш уровень доступа: "; echo $employees->role_id;
echo "<br />";
echo "Ваш отдел: "; echo $employees->department_id;
echo "<br />";
echo "Ваша должность: ";
if ($employees->position!="null")
{
    echo $employees->position;
}
else
{
    echo "just a nice guy (or girl)";
}
echo "<br />";

