<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\widgets\Pjax;

$form = ActiveForm::begin(['id'=>'wo13','options'=>['data-pjax' => true]]); ?>

<?= $form->field($model, 'order_id')->textInput(['disabled'=>true]) ?>
<?= $form->field($model, 'order_id')->hiddenInput()->label(false) ?>
<?= $form->field($model, 'department_id')->dropDownList($deps) ?>
<?= $form->field($model, 'comment')->textarea(['rows' => 6, 'required'=>"required"]) ?>

<div class="form-group">
    <?= Html::submitButton('Update', ['class' => 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end();