<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$form = ActiveForm::begin(['id'=>'wo13']); ?>
<?= $form->field($model, 'department_id')->dropDownList($deps) ?>
<?= $form->field($model, 'comment')->textarea(['rows' => 6, 'required'=>"required"]) ?>

<div class="form-group">
    <?= Html::submitButton('Update', ['class' => 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end();
