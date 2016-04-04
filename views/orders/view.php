<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Orders */

$this->title = $model->order_id;
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p> <?php \yii\widgets\Pjax::begin();?>
        <?php if (($model->status<\app\models\Statuses::find()->max('status_id'))&&($model->status>=0)) {$form = ActiveForm::begin(['action'=>['update'],'options'=>['data-pjax' => true]]); ?>
        <?= $form->field($model, 'order_id')->hiddenInput()->label(false);?>

        <?= Html::submitButton('Update', ['class' => 'btn btn-primary ']) ?>

        <?php ActiveForm::end();} ?>
        <?php if ($model->status!=-1) {$form = ActiveForm::begin(['action'=>['delete'],'options'=>['data-pjax' => true]]); ?>
        <?= $form->field($model, 'order_id')->hiddenInput()->label(false);?>

        <?= Html::submitButton('Delete', ['class' => 'btn btn-danger','data-confirm' => Yii::t('yii', 'Are you sure you want to delete selected items?'),]) ?>

        <?php ActiveForm::end(); ?>
        <?php \yii\widgets\Pjax::end();}?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'order_id',
            'employee.fio',
            'department.department_name',
            'statuses.status_name:ntext',
            'comment:ntext',
        ],
    ]) ?>
    <?=$items?>
    <?=$comments?>
</div>
